<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ActivityNameEnum;
use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\UpdateStatusRequest;
use App\Models\Activity;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

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


        $query = $this->model
            ->with('customer:id,last_name,first_name,phone');

        if ( ! empty($selectedStatus) && $selectedStatus !== 'All') {
            $query->where('status', $selectedStatus);
        }

        $data = $query->latest()->paginate(10)->withQueryString(); //nối thêm cái truy vấn

        $statuses = OrderStatusEnum::asArray();

        return view("order.index", [
                'data'           => $data,
                'statuses'       => $statuses,
                'selectedStatus' => $selectedStatus,
            ]
        );
    }

    public function show(Order $order)
    {
        $order
            ->with('customer')
            ->with('order_details', 'order_details.product');

        return view("order.show", [
            'order' => $order,
        ]);
    }

    public function update(UpdateStatusRequest $request, $orderId)
    {
        $adminId = session('admin.id');

        $this->model->where('id', $orderId)->update(
            $request->validated()
        );
        if ($request->get('status') === '2') {
            Activity::create([
                'activity' => ActivityNameEnum::ACCEPT,
                'order_id' => $orderId,
                'admin_id' => $adminId,
            ]);

            return redirect()->back()
                ->with('success', 'Duyệt đơn thành công');
        } else {
            Activity::create([
                'activity' => ActivityNameEnum::CANCEL,
                'order_id' => $orderId,
                'admin_id' => $adminId,
            ]);

            return redirect()->back()
                ->with('success', 'Huỷ đơn thành công');
        }
    }
}
