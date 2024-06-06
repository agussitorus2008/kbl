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
            array_push($ordersSevenDays, $orders->where('created_at', '>=', now()->subDays($i + 1)->startOfDay())
                ->where('created_at', '<=', now()->subDays($i + 1)->endOfDay())
                ->count());
        }

        $categories = $orders->pluck('created_at')->map(function ($date) {
            return $date->format('M d');
        });

        $data = $orders->pluck('total');


        $max = $data->max();
        $min = $data->min();
        $totalAmount = $data->sum();

        // Mengambil data order 30 hari terakhir untuk grafik
        $startDate = now()->subDays(30);
        $endDate = now();

        $orders = Order::with('schedule.car')
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->get();

        // Inisialisasi array data
        $executiveData = [];
        $executiveLabels = [];
        $nonExecutiveData = [];
        $nonExecutiveLabels = [];

        // Mengisi array data
        for ($i = 0; $i < 30; $i++) {
            array_push($executiveData, $orders->where('schedule.car.type', 'executive')
                ->where('created_at', '>=', now()->subDays($i + 1)->startOfDay())
                ->where('created_at', '<=', now()->subDays($i + 1)->endOfDay())
                ->count());
            array_push($nonExecutiveData, $orders->where('schedule.car.type', 'non-executive')
                ->where('created_at', '>=', now()->subDays($i + 1)->startOfDay())
                ->where('created_at', '<=', now()->subDays($i + 1)->endOfDay())
                ->count());
        }
        // dd($executiveData);

        // Mengisi array label
        for ($i = 0; $i < 30; $i++) {
            array_push($executiveLabels, now()->subDays($i + 1)->format('M d'));
            array_push($nonExecutiveLabels, now()->subDays($i + 1)->format('M d'));
        }

        $executivePercentage = Helper::percentageChange($orders->where('schedule.car.type', 'executive')->count(), $orders->count());
        $nonExecutivePercentage = Helper::percentageChange($orders->where('schedule.car.type', 'non-executive')->count(), $orders->count());

        $percentages = [
            $executivePercentage,
            $nonExecutivePercentage,
        ];

        $totalOrders = $orders->count();


        return view('pages.backend.dashboard.index', compact(
            'ordersThisMonth',
            'orderPercentage',
            'averageDailyOrders',
            'averageDailyOrdersPercentage',
            'customerThisMonth',
            'customerToday',
            'ordersSevenDays',
            'categories',
            'data',
            'max',
            'min',
            'totalAmount',
            'executiveData',
            'executiveLabels',
            'nonExecutiveData',
            'nonExecutiveLabels',
            'percentages',
            'executivePercentage',
            'nonExecutivePercentage',
            'totalOrders'
        ));
    }
}
