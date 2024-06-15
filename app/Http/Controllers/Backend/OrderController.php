<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Notifications\NewCouponNotification;
use App\Notifications\ApprovedOrderNotification;
use App\Notifications\RejectedOrderNotification;

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
                ->addColumn('action', function ($collection) {
                    if ($collection->status == 'pending' || $collection->status == 'cancled') {
                        return '
                        <div class="btn-group" role="group">
                            <a href="javascript:;" onclick="handle_confirm(\'Apakah Anda Yakin?\',\'Yakin\',\'Tidak\',\'PATCH\',\'' . route('backend.orders.approve', $collection->id) . '\');"
                            class="btn btn-sm btn-success">
                                <i class="fa fa-check"></i>
                            </a>
                            <a href="javascript:;" onclick="handle_confirm(\'Apakah Anda Yakin?\',\'Yakin\',\'Tidak\',\'PATCH\',\'' . route('backend.orders.reject', $collection->id) . '\');"
                                class="btn btn-sm btn-danger">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>';
                    }
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('pages.backend.orders.index');
    }
}
