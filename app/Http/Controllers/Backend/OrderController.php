<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::with('user', 'schedule', 'orderDetails', 'coupon');

            return DataTables::of($orders)
                ->addColumn('status', function ($order) {
                    return '<span class="badge badge-' . ($order->status == 'rejected' || $order->status == 'canceled' ? 'danger' : 'warning') . '">' . $order->status . '</span>';
                })
                ->addColumn('total_price', function ($order) {
                    return number_format($order->total_price, 0, ',', '.');
                })
                ->addColumn('total_seat', function ($order) {
                    return $order->orderDetails->count();
                })
                ->addColumn('departure_time', function ($order) {
                    return Carbon::parse($order->departure_time)->translatedFormat('d F Y');
                })
                ->addColumn('created_at', function ($order) {
                    return Carbon::parse($order->created_at)->translatedFormat('d F Y');
                })
                ->rawColumns(['status'])
                ->make(true);
        }

        return view('pages.backend.orders.index');
    }
}
