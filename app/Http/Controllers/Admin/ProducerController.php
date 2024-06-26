<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Producer\DestroyRequest;
use App\Http\Requests\Producer\StoreRequest;
use App\Http\Requests\Producer\UpdateRequest;
use App\Models\Category;
use App\Models\Producer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class ProducerController extends Controller
{
    private object $model;

    public function __construct()
    {
        $this->model = (new Producer())->query();

        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName); //cắt chuỗi
        $arr = array_map('ucfirst', $arr); // viết hoa chữ cái đầu
        $title = implode(' - ', $arr); // nối nhau bằng dấu '-'

        View::share('title', $title); //chia sẻ title đến mọi nơi trong controller
    }

    public function index()
    {
        return view('producer.index');
    }

    public function api()
    {
        return DataTables::of($this->model)
            ->editColumn('created_at', function ($object) {
                return $object->created_at->format('d/m/Y');
            })
            ->addColumn('edit', function ($object) {
                return route('producers.edit', $object); //server side rendering
            })
            ->make(true);
    }

    public function create()
    {
        return view('producer.create');
    }

    public function store(StoreRequest $request)
    {
        $this->model->create($request->validated());

        return redirect()->route('producers.index');
    }


    public function edit(Producer $producer)
    {
        return view('producer.edit', [
            'each' => $producer,
        ]);
    }

    public function update(UpdateRequest $request, $producerId)
    {
        $this->model->where('id', $producerId)
            ->update(
                $request->validated()
            );

        return redirect()->route('producers.index');
    }
}
