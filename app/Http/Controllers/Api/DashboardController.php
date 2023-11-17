<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Order;
use App\Helpers\Helper;
use App\Helpers\ResponseFormatter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DashboardResource;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $ordersThisMonth = Order::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();

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

        $ordersSevenDays = $this->getOrdersSevenDays();

        $categories = $this->getOrderCategories();

        $max = $this->getMaxOrderAmount();
        $min = $this->getMinOrderAmount();
        $totalAmount = $this->getTotalOrderAmount();

        $executiveData = $this->getExecutiveOrderData();
        $executiveLabels = $this->getExecutiveOrderLabels();

        $nonExecutiveData = $this->getNonExecutiveOrderData();
        $nonExecutiveLabels = $this->getNonExecutiveOrderLabels();

        $executivePercentage = Helper::percentageChange($this->getExecutiveOrderCount(), $this->getTotalOrderCount());
        $nonExecutivePercentage = Helper::percentageChange($this->getNonExecutiveOrderCount(), $this->getTotalOrderCount());

        $percentages = [
            $executivePercentage,
            $nonExecutivePercentage,
        ];

        $totalOrders = $this->getTotalOrderCount();

        return ResponseFormatter::success(
            new DashboardResource(compact(
                'ordersThisMonth',
                'orderPercentage',
                'averageDailyOrders',
                'averageDailyOrdersPercentage',
                'customerThisMonth',
                'customerToday',
                'ordersSevenDays',
                'categories',
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
            )),
            'Data dashboard berhasil diambil'
        );
    }

    private function getOrdersSevenDays()
    {
        $orders = Order::with('schedule.car')
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->get();

        $ordersSevenDays = [];
        for ($i = 0; $i < 7; $i++) {
            array_push($ordersSevenDays, $orders->where('created_at', '>=', now()->subDays($i + 1)->startOfDay())
                ->where('created_at', '<=', now()->subDays($i + 1)->endOfDay())
                ->count());
        }

        return $ordersSevenDays;
    }
}
