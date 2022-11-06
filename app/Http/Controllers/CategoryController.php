<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
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
        $arr    = explode('.', $routeName); //cắt chuỗi
        $arr    = array_map('ucfirst', $arr); // viết hoa chữ cái đầu
        $title  = implode(' - ', $arr); // nối nhau bằng dấu '-'

        View::share('title', $title); //chia sẻ title đến mọi nơi trong controller
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
            ->addColumn('edit', function($object) {
                return route('categories.edit', $object); //server side rendering
            })
            ->addColumn('destroy', function($object) {
                return route('categories.destroy', $object); //client side rendering
            })
            ->addColumn('producer', function($object) {
                return $object->producer->name;
            })


            ->make(true);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('category.edit');
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    public function destroy(Category $category)
    {
        $category->delete();

        $arr = [];
        $arr['status'] = true;
        $arr['message'] = '';

        return response( $arr, 200);
    }
}
