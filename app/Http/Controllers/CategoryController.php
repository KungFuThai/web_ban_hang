<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\DestroyRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\Models\Producer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    private Builder $model;

    public function __construct()
    {
        $this->model = (new Category())->query();

        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName); //cắt chuỗi
        $arr = array_map('ucfirst', $arr); // viết hoa chữ cái đầu
        $title = implode(' - ', $arr); // nối nhau bằng dấu '-'

        View::share('title',
            $title); //chia sẻ title đến mọi nơi trong controller
    }

    public function index()
    {
        return view('category.index');
    }

    public function api()
    {
        return DataTables::of($this->model->with('producer'))
            ->editColumn('created_at', function ($object) {
                return $object->created_at->format('d/m/Y');
            })
            ->addColumn('edit', function ($object) {
                return route('categories.edit',
                    $object); //server side rendering
            })
            ->addColumn('destroy', function ($object) {
                return route('categories.destroy',
                    $object); //client side rendering
            })
            ->addColumn('producer', function ($object) {
                return $object->producer->name;
            })
            ->make(true);
    }

    public function create()
    {
        $producers = Producer::query()->get();
        return view('category.create', [
            'producers' => $producers,
            ],
        );
    }

    public function store(StoreRequest $request)
    {
        $this->model->create($request->validated());

        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        $producers = Producer::query()->get();
        return view('category.edit', [
            'each' => $category,
            'producers' => $producers,
        ]);
    }


    public function update(UpdateRequest $request, $categoryId)
    {
        $this->model->where('id', $categoryId)->update(
            $request->validated()
        );

        return redirect()->route('categories.index');
    }

    public function destroy(DestroyRequest $request, $categoryId)
    {
        $this->model->where('id', $categoryId)->delete();

        $arr = [];
        $arr['status'] = true;
        $arr['message'] = '';

        return response($arr, 200);
    }
}
