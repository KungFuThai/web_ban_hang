<?php

namespace App\Http\Controllers\Customer;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CartController extends Controller
{
    public function index()
    {
        $id = session('customer.id');
        $customer = Customer::query()->find($id);
        return view('homepage.customer.cart',[
            'customer' => $customer,
        ]);
    }

    public function addToCart(Request $request, $productId)
    {
        $product = Product::query()->find($productId);
        if ( ! $product) {
            return redirect()->back()->with('error', 'Bạn đang cố gắng thêm một sản phẩm không tồn tại!');
        }

        $cart = session()->get('cart');
        // giỏ hàng không có gì
        if (empty($cart)) {
            $cart = [
                $productId => [
                    "name"     => $product->name,
                    "quantity" => 1,
                    "price"    => $product->price,
                    "image"    => $product->image,
                ]
            ];
            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công');
        }
        // thêm vào một sản phẩm đã tồn tại trong giỏ hàng
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công');
        }
        // thêm vào một sản phẩm chưa tồn tại trong giỏ hàng
        $cart[$productId] = [
            "name"     => $product->name,
            "quantity" => 1,
            "price"    => $product->price,
            "image"    => $product->image,
        ];
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công');
    }

    public function updateQuantity(Request $request)
    {
        $productId = $request->id;
        $type = $request->type;
        $cart = session()->get('cart');

        if($type === '0'){
            if($cart[$productId]['quantity'] > 1){
                $cart[$productId]['quantity']--;
            }else{
                unset($cart[$productId]);
            }
        }else{
            $cart[$productId]['quantity']++;
        }
        session()->put('cart', $cart);
    }

    public function removeFromCart(Request $request)
    {
        $productId = $request->id;
        if ($productId) {
            $cart = session()->get('cart');
            if (isset($cart[$productId])) {
                unset($cart[$productId]);
                session()->put('cart', $cart);
            }
        }
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart');
        if($cart){
            $name_receiver = $request->get('name_receiver');
            $phone_receiver = $request->get('phone_receiver');
            $address_receiver = $request->get('address_receiver');
            $customer_id = session('customer.id');

            $total_price = 0;
            foreach ($cart as $each) {
                $total_price += $each['quantity'] * $each['price'];
            }

            $order = Order::query()
                ->create([
                    'name_receiver' => $name_receiver,
                    'phone_receiver' => $phone_receiver,
                    'address_receiver' => $address_receiver,
                    'status' => OrderStatusEnum::PENDING,
                    'total_price' => $total_price,
                    'customer_id' => $customer_id,
                ]);

            foreach($cart as $productId => $each) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'unit_price' => $each['price'],
                    'quantity' => $each['quantity'],
                    'product_id' => $productId,
                ]);
            }

            session()->forget('cart');
            return redirect()->route('customer.index')->with('success', 'Chúc mừng bạn đã đặt hàng thành công!');
        }
        return redirect()->back()->with('error', 'Bạn cần có sản phẩm trong giỏ hàng để tiến hành thanh toán!');

    }
}
