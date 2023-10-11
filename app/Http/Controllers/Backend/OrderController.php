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
            $orders = Order::with('user', 'schedule', 'order_details')
                ->orderBy('id', 'desc')
                ->get();

            return DataTables::of($orders)
                ->addColumn('action', function ($order) {
                    if (in_array($order->status, ['pending', 'canceled'])) {
                        $approveRoute = route('backend.orders.approve', $order->id);
                        $rejectRoute = route('backend.orders.reject', $order->id);

                        return '
                    <div class="btn-group" role="group">
                        <a href="javascript:;" onclick="handle_confirm(\'Apakah Anda Yakin?\',\'Yakin\',\'Tidak\',\'PATCH\',\'' . $approveRoute . '\');"
                        class="btn btn-sm btn-success">
                            <i class="fa fa-check"></i>
                        </a>
                        <a href="javascript:;" onclick="handle_confirm(\'Apakah Anda Yakin?\',\'Yakin\',\'Tidak\',\'PATCH\',\'' . $rejectRoute . '\');"
                            class="btn btn-sm btn-danger">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>';
                    }
                })
                ->addColumn('status', function ($order) {
                    return '<span class="badge badge-' . ($order->status == 'rejected' || $order->status == 'canceled' ? 'danger' : 'warning') . '">' . $order->status . '</span>';
                })
                ->addColumn('total_price', function ($order) {
                    return number_format($order->total_price, 0, ',', '.');
                })
                ->addColumn('departure_time', function ($order) {
                    return Carbon::parse($order->departure_time)->translatedFormat('d F Y');
                })
                ->addColumn('created_at', function ($order) {
                    return Carbon::parse($order->created_at)->translatedFormat('d F Y');
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('pages.backend.orders.index');
    }

    /**
     * Approve the specified resource in storage.
     */
    public function approve(Order $order)
    {
        $order->update([
            'status' => 'booked',
        ]);

        $user = User::find($order->user_id);

        // Get booked orders of the user
        $bookedOrders = $user->orders()->where('status', 'booked')->get();

        // Calculate the number of seats booked in this order
        $seatsCount = $bookedOrders->sum(function ($order) {
            return $order->order_details->count();
        });

        // Calculate the number of new coupons the user should receive
        $getCoupon = floor($seatsCount / 5);

        // Get the count of coupons the user currently has
        $couponCount = $user->coupons()->count();

        // Update the schedule's available seats
        $schedule = $order->schedule;
        $schedule->available_seats -= $seatsCount;
        $schedule->save();

        if ($order->coupon_id) {
            $coupon = Coupon::find($order->coupon_id);
            $coupon->limit -= 1;

            if ($coupon->limit == 0) {
                $coupon->used = 1;
            }

            $coupon->save();
        }

        if ($couponCount < $getCoupon) {
            // Create new coupons for the user
            for ($i = 0; $i < $getCoupon - $couponCount; $i++) {
                $newCoupon = new Coupon;
                $newCoupon->user_id = $user->id;
                $newCoupon->code = Helper::generate_coupon_code();
                $newCoupon->discount = 50;
                $newCoupon->limit = 2;
                $newCoupon->save();
            }

            // Notify the user about the new coupons
            $user->notify(new NewCouponNotification());
        }

        // Notify the user about the approved order
        $user->notify(new ApprovedOrderNotification());

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil disimpan',
        ]);
    }

    /**
     * Reject the specified resource in storage.
     */
    public function reject(Order $order)
    {
        $order->update([
            'status' => 'rejected',
        ]);

        $user = User::find($order->user_id);
        $user->notify(new RejectedOrderNotification());

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil disimpan',
        ]);
    }
}
