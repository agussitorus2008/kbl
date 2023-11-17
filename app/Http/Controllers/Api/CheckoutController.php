<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Helpers\Helper;
use App\Models\Schedule;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function confirm(Request $request)
    {
        $schedule = Schedule::find($request->schedule_id);
        $seats = $request->seats;
        $seats = explode(',', $seats[0]);
        $seats_count = count($seats);
        return ResponseFormatter::success(
            compact('schedule', 'seats', 'seats_count'),
            'Data order berhasil diambil'
        );
    }

    public function check_coupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon)->first();
        $schedule = Schedule::find($request->schedule_id);
        $seats = $request->seats;
        $seats = explode(',', $seats);
        if ($coupon) {
            if ($coupon->used == 1) {
                return ResponseFormatter::error(
                    ['error' => 'Kode kupon sudah digunakan'],
                    'Data kupon gagal diambil',
                    422
                );
            } elseif ($coupon->expired_at < now()) {
                return ResponseFormatter::error(
                    ['error' => 'Kode kupon sudah kadaluarsa'],
                    'Data kupon gagal diambil',
                    422
                );
            } elseif ($coupon->min_price > $schedule->price) {
                return ResponseFormatter::error(
                    ['error' => 'Kode kupon tidak dapat digunakan'],
                    'Data kupon gagal diambil',
                    422
                );
            } else {
                $price = $schedule->price * count($seats);
                $discount = $price * ($coupon->discount / 100);
                $total = $price - $discount;
                $coupon->save();

                return ResponseFormatter::success(
                    compact('coupon', 'total', 'price', 'schedule', 'discount', 'total_discount'),
                    'Data kupon berhasil diambil'
                );
            }
        } else {
            return ResponseFormatter::error(
                ['error' => 'Kode kupon tidak ditemukan'],
                'Data kupon gagal diambil',
                422
            );
        }
    }

    public function payment(Request $request)
    {
        $validators = Validator::make($request->all(), []);

        if ($validators->fails()) {
            return ResponseFormatter::error(
                ['error' => $validators->errors()],
                'Data gagal ditambahkan',
                422
            );
        }
    }

    public function do_checkout(Request $request)
    {
        $schedule = Schedule::find($request->schedule_id);
        $route = $schedule->route;
        $seats = $request->seats;
        $seats = explode(',', $seats);
        $seats_count = count($seats);
        $discount = 0;
        if ($request->coupon_id) {
            $coupon = Coupon::find($request->coupon_id);
            $discount = $schedule->price * $coupon->discount / 100;
        }
        $price = $schedule->price - $discount;
        $total = $price * $seats_count;

        $order = new Order;
        $order->code = Helper::generate_order_code();
        $order->user_id = auth()->user()->id;
        $order->schedule_id = $request->schedule_id;
        $order->coupon_id = $request->coupon_id;
        $order->total = $total;
        $order->save();
        foreach ($seats as $seat) {
            $orderDetail = new OrderDetail;
            $orderDetail->order_id = $order->id;
            $orderDetail->seat_id = $seat;
            $orderDetail->save();
        }

        if ($schedule->route == 'ML') {
            $from = 'Medan';
            $to = 'Laguboti';
        } elseif ($schedule->route == 'LB') {
            $from = 'Laguboti';
            $to = 'Medan';
        } elseif ($schedule->route == 'SL') {
            $from = 'Sibolga';
            $to = 'Laguboti';
        } else {
            $from = 'Laguboti';
            $to = 'Sibolga';
        }

        $admin = User::where('id', 1)->first();
        $admin->notify(new \App\Notifications\NewOrderNotification($order, $from, $to, $schedule));

        $user = User::where('id', auth()->user()->id)->first();
        $user->notify(new \App\Notifications\OrderCreatedNotification($order));

        return ResponseFormatter::success(
            compact('order', 'from', 'to', 'schedule'),
            'Data order berhasil disimpan'
        );
    }
}
