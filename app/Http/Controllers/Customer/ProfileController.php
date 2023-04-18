<?php

namespace App\Http\Controllers\Customer;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\UpdateProfileRequest;
use App\Http\Requests\HomePage\CancelOrderRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function edit()
    {
        $id = session('customer.id');
        $customer = Customer::query()
            ->find($id);

        $stringEmail = $customer->email;
        $stringPhone = $customer->phone;
        $email = Str::mask($stringEmail, '*', 2, 5);
        $phone = Str::mask($stringPhone, '*', 3, 6);

        return view('homepage.customer.profile', [
            'customer' => $customer,
            'email'    => $email,
            'phone'    => $phone,
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {
        $id = session('customer.id');
        $arr = $request->validated();
        $object = Customer::query()->find($id);

        if ($request->hasFile('avatar')) {
            $path = Storage::disk('public')->putFile('customer_avatar', $request->file('avatar'));

            $arr['avatar'] = $path;

            if (File::exists(public_path('storage/'.$object->avatar))) {
                File::delete(public_path('storage/'.$object->avatar));
            }
        }

        $object->update($arr);

        $customer = session()->get('customer');
        $customer = [
            'id'        => $object->id,
            'full_name' => $object->full_name,
            'avatar'    => $object->avatar,
        ];
        session()->put('customer', $customer);

        return redirect()->back()->with('success', 'Cập nhật thông tin cá nhân thành công!');
    }

    public function check()
    {
        $customerId = session()->get('customer.id');
        $orders = Order::query()
            ->where('customer_id', $customerId)
            ->latest()
            ->paginate(5);

        return view('homepage.check.index', [
            'orders' => $orders,
        ]);
    }

    public function checkDetail(Request $request)
    {
        $orderId = $request->order_id;

        $customerId = session()->get('customer.id');
        $orderIds = Order::query()
            ->where('customer_id', $customerId)->pluck('id')->toArray();

        if (in_array($orderId, $orderIds)) {
            $order = Order::query()->find($orderId);

            $orderDetail = OrderDetail::query()
                ->where('order_id', $orderId)
                ->with('product:id,name,image')
                ->get();

            return view('homepage.check.show', [
                'orderDetail' => $orderDetail,
                'order'       => $order,
            ]);
        }

        return redirect()->route('customer.profile.check');
    }

    public function cancelOrder(CancelOrderRequest $request, $orderId)
    {
        $customerId = session()->get('customer.id');
        $orderIds = Order::query()
            ->where('customer_id', $customerId)->pluck('id')->toArray();

        if (in_array($orderId, $orderIds)) {
            $order = Order::query()
                ->find($orderId);
            $orderStatus = $order->status;

            if ($orderStatus === OrderStatusEnum::PENDING) {
                $order->update([
                    'status' => OrderStatusEnum::CANCEL,
                ]);

                return redirect()->back()->with('success', 'Huỷ đơn hàng thành công!');
            }

            return redirect()->back();
        }

        return redirect()->back();
    }
}
