<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Notifications\NewCouponNotification;
use App\Notifications\ApprovedOrderNotification;
use App\Notifications\RejectedOrderNotification;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['schedule', 'user', 'coupon', 'orderDetails'])->get();

        return ResponseFormatter::success(
            new OrderCollection($orders),
            'Data list order berhasil diambil'
        );
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

        return ResponseFormatter::success(
            new OrderResource($order),
            'Data order berhasil disimpan'
        );
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

        return ResponseFormatter::success(
            new OrderResource($order),
            'Data order berhasil disimpan'
        );
    }
}
