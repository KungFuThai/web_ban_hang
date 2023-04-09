<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

class TestController extends Controller
{
    public function index()
    {
//        $lastMonth = Carbon::parse('last month')->format('m');
//        $lastDay = Carbon::parse('last day of last month')->format('d');
//        dd($lastDay . '/' . $lastMonth);
//        $maxDate = 7;
//        $date = now()->subDays($maxDate);
//        $arr = [];
//        $today = (int)(now()->format('d'));
//        $today = now('Asia/Ho_Chi_Minh');
//        if ($today < $maxDate) {
//            dd(1);
//            $getDayOfPreviousMonth = $maxDate - $today;
//            $lastMonth = now()->subMonthsNoOverflow()->format('m');
//            $lastDayOfPreviousMonth = now()->subMonthsNoOverflow()->endOfMonth()->format('d');
//            $startDayOfPreviousMonth = $lastDayOfPreviousMonth - $getDayOfPreviousMonth;
//            for ($i = $startDayOfPreviousMonth; $i <= $lastDayOfPreviousMonth; $i++) {
//                $key = $i.'-'.$lastMonth;
//                $arr[$key] = 0;
//            }
//            $startDayThisMonth = 1;
//        } else {
//            $startDayThisMonth = $today - $maxDate;
//        }
//        $data = Order::query()->where('created_at', '>=', $date)
//            ->groupBy('day')
//            ->get(array(
//                DB::raw('DATE_FORMAT(created_at, "%e-%m") as day'),
//                DB::raw('sum(total_price) as revenue')
//            ));
//        $thisMonth = now()->format('m');
//        for ($i = $startDayThisMonth; $i <= $today; $i++) {
//            $key = $i.'-'.$thisMonth;
//            $arr[$key] = 0;
//        }
//        foreach ($data as $each) {
//            $arr[$each['day']] = (float)$each['revenue'];
//        }
//        $arrX = array_keys($arr);
//        $arrY = array_values($arr);
//        dd($today);
    }
}
