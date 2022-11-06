<?php

namespace App\Http\Controllers;

use App\Models\Producer;
use App\Http\Requests\StoreProducerRequest;
use App\Http\Requests\UpdateProducerRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class ProducerController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        $this->model = (new Producer())->query();

        $routeName = Route::currentRouteName();
        $arr    = explode('.', $routeName); //cắt chuỗi
        $arr    = array_map('ucfirst', $arr); // viết hoa chữ cái đầu
        $title  = implode(' - ', $arr); // nối nhau bằng dấu '-'

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
            ->addColumn('edit', function($object) {
                return route('producers.edit', $object); //server side rendering
//                $link = route('products.edit', $object);
//                return "<a class='btn btn-primary' href='$link'>Edit</a>"; //server side rendering
            })
            ->addColumn('destroy', function($object) {
                return route('producers.destroy', $object); //client side rendering
            })
//            ->rawColumns(['edit']) //server side rendering


            ->make(true);
    }

    public function create()
    {
        return view('producer.create');
    }

    public function store(StoreProducerRequest $request)
    {
        //
    }


    public function edit(Producer $producer)
    {
        return view('producer.edit', [
            'producer' => $producer,
        ]);
    }

    public function update(UpdateProducerRequest $request, Producer $producer)
    {
        //
    }

    public function destroy(Producer $producer)
    {
        $producer->delete();

        $arr = [];
        $arr['status'] = true;
        $arr['message'] = '';

        return response( $arr, 200);
    }
}
