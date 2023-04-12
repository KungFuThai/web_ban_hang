<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->model = (new Activity())->query();

        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName); //cắt chuỗi
        $arr = array_map('ucfirst', $arr); // viết hoa chữ cái đầu
        $title = implode(' - ', $arr); // nối nhau bằng dấu '-'

        View::share('title',
            $title); //chia sẻ title đến mọi nơi trong controller
    }

    public function index()
    {
        return view('activity.index');
    }

    public function api()
    {
        return DataTables::of($this->model
            ->with('admin')
            ->with('order:id')) //láy kèm theo
            ->editColumn('created_at', function ($object) {
                return $object->time_created_at;
            })
            ->addColumn('admin_name', function ($object) {
                return $object->admin->full_name;
            })
            ->addColumn('activity_name', function ($object) {
                return $object->activity_name;
            })
            ->make(true);
    }
}
