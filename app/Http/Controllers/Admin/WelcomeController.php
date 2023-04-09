<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Producer;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class WelcomeController extends Controller
{
    use ResponseTrait;
    public function __construct()
    {

        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName); //cắt chuỗi
        $arr = array_map('ucfirst', $arr); // viết hoa chữ cái đầu
        $title = implode(' - ', $arr); // nối nhau bằng dấu '-'

        View::share('title', $title);
    }
    public function index()
    {
        //count
        $productCount = Product::query()->count();
        $categoryCount = Category::query()->count();
        $producerCount = Producer::query()->count();
        $orderCount = Order::query()->count();
        $customerCount = Customer::query()->count();
        $adminCount = Admin::query()
            ->where('role',1)
            ->count();
        //end count

        return view('welcome.index',[
            'productCount' => $productCount,
            'categoryCount' => $categoryCount,
            'producerCount' => $producerCount,
            'orderCount' => $orderCount,
            'customerCount' => $customerCount,
            'adminCount' => $adminCount,
        ]);
    }

    public function getRevenue(Request $request)
    {
        $arr = [];
        $maxDate = $request->days;
        $date = now()->subDays($maxDate);
        $today = (int)(now()->format('d'));
        if ($today < $maxDate) {
            $getDayOfPreviousMonth = $maxDate - $today;
            $previousMonth = Carbon::parse('last month')->format('m');
            $lastDayOfPreviousMonth = Carbon::parse('last day of last month')->format('d');
            $startDayOfPreviousMonth = $lastDayOfPreviousMonth - $getDayOfPreviousMonth;
            //for "Previous Month"
            for ($i = $startDayOfPreviousMonth; $i <= $lastDayOfPreviousMonth; $i++) {
                $key = $i . '-' . $previousMonth;
                $arr[$key] = 0;
            }
            $startDayThisMonth = 1;
        } else {
            $startDayThisMonth = $today - $maxDate;
        }
        $data = Order::query()->whereDate('created_at', '>=', $date)
            ->where('status', OrderStatusEnum::ACCEPT)
            ->groupBy('day')
            ->get(array(
                DB::raw('DATE_FORMAT(created_at, "%e-%m") as day'),
                DB::raw('sum(total_price) as revenue')
            ));// lấy dữ liệu ra ép vào mảng rồi đặt tên lại
        $thisMonth = now()->format('m');
        //for "this month"
        for ($i = $startDayThisMonth; $i <= $today; $i++) {
            $key = $i.'-'.$thisMonth;
            $arr[$key] = 0;
        }
        foreach ($data as $each) {
            $arr[$each['day']] = (int)$each['revenue'];
        }
        return $this->successResponse($arr);
    }
}
