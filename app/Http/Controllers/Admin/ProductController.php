<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
//use App\Http\Requests\Product\CheckSlugRequest;
use App\Http\Requests\Product\DestroyRequest;
use App\Http\Requests\Product\GenerateSlugRequest;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    use ResponseTrait;
    private object $model;

    public function __construct()
    {
        $this->model = (new Product())->query();

        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName); //cắt chuỗi
        $arr = array_map('ucfirst', $arr); // viết hoa chữ cái đầu
        $title = implode(' - ', $arr); // nối nhau bằng dấu '-'

        View::share(
            'title',
            $title
        ); //chia sẻ title đến mọi nơi trong controller
    }

    public function index()
    {
        return view('product.index');
    }

    public function api()
    {
        return DataTables::of($this->model->with('category:id,name')) //láy kèm theo
            ->editColumn('created_at', function ($object) {
                return $object->created_at->format('d/m/Y');
            })
            ->addColumn('edit', function ($object) {
                return route('products.edit', $object);
            })
            ->addColumn('category', function ($object) {
                return $object->category->name;
            })
            ->make(true);
    }

    public function create()
    {
        $categories = Category::query()->get();

        return view(
            'product.create',
            [
                'categories' => $categories,
            ],
        );
    }

    public function generateSlug(GenerateSlugRequest $request): JsonResponse
    {
        try {
            $name = $request->get('name');
            $slug = SlugService::createSlug(Product::class, 'slug', $name);

            return $this->successResponse($slug);
        } catch (\Throwable $e) {
            return $this->errorResponse();
        }
    }

    public function store(StoreRequest $request)
    {
        $path = Storage::disk('public')->putFile('products', $request->file('image'));
        $arr = $request->validated();
        $arr['image'] = $path;
        $this->model->create($arr);

        return redirect()->back()->with('success', 'Đã thêm sản phẩm thành công');
    }


    public function edit(Product $product)
    {
        $categories = Category::query()->get();

        return view('product.edit', [
            'each'     => $product,
            'categories' => $categories,
        ]);
    }

    public function update(UpdateRequest $request, $productId)
    {
        $arr = $request->validated();
        $object = $this->model->find($productId);

        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->putFile('products', $request->file('image'));

            $arr['image'] = $path;

            if (File::exists(public_path('storage/' . $object->image))) {
                File::delete(public_path('storage/' . $object->image));
            }
        }

        $object->update($arr);

        return redirect()->route('products.index')->with('success', 'Đã cập nhật sản phẩm thành công');
    }
}
