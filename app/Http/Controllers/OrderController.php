<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatusEnum;
use App\Http\Requests\Order\UpdateStatusRequest;
use App\Models\Activity;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class OrderController extends Controller
{
    private object $model;

    public function __construct()
    {
        $this->model = (new Order())->query();

        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName); //cắt chuỗi
        $arr = array_map('ucfirst', $arr); // viết hoa chữ cái đầu
        $title = implode(' - ', $arr); // nối nhau bằng dấu '-'

        View::share('title',
            $title); //chia sẻ title đến mọi nơi trong controller
    }

    public function index(Request $request)
    {
        $selectedStatus = $request->get('status');


        $query = $this->model->with('customer:id,last_name,first_name,phone');

        if ( ! empty($selectedStatus) && $selectedStatus !== 'All') {
            $query->where('status', $selectedStatus);
        }

        $data = $query->latest()->paginate(10);

        $statuses = OrderStatusEnum::asArray();

        return view("order.index", [
                'data'           => $data,
                'statuses'       => $statuses,
                'selectedStatus' => $selectedStatus,
            ]
        );
    }

    public function create()
    {
        //
    }

    public function store(StoreOrderRequest $request)
    {
        //
    }

    public function show(Order $order)
    {
        //
    }

    public function edit(Order $order)
    {
        //
    }

    public function update(UpdateStatusRequest $request, $orderId)
    {
        $adminId = session()->get('id');

        $this->model->where('id', $orderId)->update(
            $request->validated()
        );
        if ($request->get('status') === '2') {
            Activity::create([
                'activity' => 1,
                'order_id' => $orderId,
                'admin_id' => $adminId,
            ]);
            return redirect()->route('orders.index')
                ->with('success', 'Duyệt đơn thành công');
        } else {
            Activity::create([
                'activity' => 2,
                'order_id' => $orderId,
                'admin_id' => $adminId,
            ]);
            return redirect()->route('orders.index')
                ->with('success', 'Huỷ đơn thành công');
        }
    }

    public function destroy(Order $order)
    {

    }
}
