<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalUsers = User::role('customer')->count();
        $totalCoupons = Coupon::count();
        $totalOrders = Order::count();

        return view('pages.backend.dashboard.index', compact('totalUsers', 'totalCoupons', 'totalOrders'));
    }
}
