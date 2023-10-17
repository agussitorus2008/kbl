<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan data yang diperlukan untuk grafik
        $ordersThisMonth = Order::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();
        // persentase perbandingan order bulan ini dengan bulan lalu
        $orderPercentage = Helper::diffPercentageChange($ordersThisMonth, Order::whereMonth('created_at', date('m', strtotime('-1 month')))
            ->whereYear('created_at', date('Y', strtotime('-1 month')))
            ->count());
        $averageDailyOrders = round(Order::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count() / date('t'));
        $averageDailyOrdersPercentage = Helper::diffPercentageChange($averageDailyOrders, round(Order::whereMonth('created_at', date('m', strtotime('-1 month')))
            ->whereYear('created_at', date('Y', strtotime('-1 month')))
            ->count() / date('t', strtotime('-1 month'))));
        $customerThisMonth = User::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();
        $customerToday = User::whereDate('created_at', date('Y-m-d'))
            ->count();

        // array data untuk grafik, data order dalam 7 hari terakhir
        // Mengambil data order dari database
        $orders = Order::with('schedule.car')
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->get();
        // Mengambil data banyaknya order dalam 7 hari terakhir
        $ordersSevenDays = [];
        for ($i = 0; $i < 7; $i++) {
            $ordersSevenDays[$i] = $orders->where('created_at', '>=', now()->subDays(7 - $i))->where('created_at', '<=', now()->subDays(6 - $i))->count();
        }

        $categories = $orders->pluck('created_at')->map(function ($date) {
            return $date->format('M d');
        });

        $data = $orders->pluck('total');


        $max = $data->max();
        $min = $data->min();
        $totalAmount = $data->sum();

        // array data untuk grafik, data banyaknya order dalam 7 hari terakhir
        $executiveSevenDays = [];
        for ($i = 0; $i < 7; $i++) {
            $executiveSevenDays[$i] = $orders->where('schedule.car.type', 'executive')->where('created_at', '>=', now()->subDays(7 - $i))->where('created_at', '<=', now()->subDays(6 - $i))->count();
        }


        $nonExecutiveSevenDays = [];
        for ($i = 0; $i < 7; $i++) {
            $nonExecutiveSevenDays[$i] = $orders->where('schedule.car.type', 'non-executive')->where('created_at', '>=', now()->subDays(7 - $i))->where('created_at', '<=', now()->subDays(6 - $i))->count();
        }

        // dd($executiveSevenDays);
        $sevenDays = [];
        for ($i = 0; $i < 7; $i++) {
            $sevenDays[$i] = now()->subDays(7 - $i)->format('M d');
        }

        $executivePercentage = Helper::percentageChange($orders->where('schedule.car.type', 'executive')->count(), $orders->count());
        $nonExecutivePercentage = Helper::percentageChange($orders->where('schedule.car.type', 'non-executive')->count(), $orders->count());

        $percentages = [
            $executivePercentage,
            $nonExecutivePercentage,
        ];
        // Mendapatkan data yang diperlukan untuk card
        $totalUsers = User::count();
        $totalCoupons = Coupon::count();
        $totalOrders = Order::count();

        return view('pages.backend.dashboard.index', compact('totalUsers', 'totalCoupons', 'totalOrders', 'ordersThisMonth', 'orderPercentage', 'averageDailyOrders', 'averageDailyOrdersPercentage', 'customerThisMonth', 'customerToday', 'ordersSevenDays', 'categories', 'data', 'max', 'min', 'totalAmount', 'executivePercentage', 'nonExecutivePercentage', 'percentages', 'executiveSevenDays', 'nonExecutiveSevenDays', 'sevenDays'));
    }
}
