<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        $this->model = (new Product())->query();

        $routeName = Route::currentRouteName();
        $arr    = explode('.', $routeName); //cắt chuỗi
        $arr    = array_map('ucfirst', $arr); // viết hoa chữ cái đầu
        $title  = implode(' - ', $arr); // nối nhau bằng dấu '-'

        View::share('title', $title); //chia sẻ title đến mọi nơi trong controller
    }

    public function index()
    {
        return view('product.index');
    }

    public function api()
    {
        return DataTables::of($this->model->with('category')->with('producer'))
            ->editColumn('created_at', function ($object) {
                return $object->created_at->format('d/m/Y');
            })
            ->addColumn('edit', function($object) {
                return route('products.edit', $object); //server side rendering
//                $link = route('products.edit', $object);
//                return "<a class='btn btn-primary' href='$link'>Edit</a>"; //server side rendering
            })
            ->addColumn('destroy', function($object) {
                return route('products.destroy', $object); //client side rendering
            })
            ->addColumn('category', function($object) {
                return $object->category->name;
            })
            ->addColumn('producer', function($object) {
                return $object->producer->name;
            })
//            ->rawColumns(['edit']) //server side rendering


            ->make(true);
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(StoreProductRequest $request)
    {
        //
    }


    public function edit(Product $product)
    {
        return view('product.edit', [
            'product' => $product,
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
//        Product::destroy($product);
        $product->delete();
//        return redirect()->route('products.index');
        $arr = [];
        $arr['status'] = true;
        $arr['message'] = '';

        return response( $arr, 200);
    }
}
