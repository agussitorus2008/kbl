<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Notifications\OrderSuccess;
use App\Services\Midtrans\CallbackService;

class PaymentCallbackController extends Controller
{
    public function receive()
    {
        $callback = new CallbackService;

        if ($callback->isSignatureKeyVerified()) {
            $notification = $callback->getNotification();
            $order = $callback->getOrder();

            if ($callback->isSuccess()) {
                Order::where('code', $order->id)->update([
                    'payment_status' => 2,
                    'status' => 'booked',
                ]);

                $notification->setTransactionStatus('settlement');
                $user = User::where('id', $order->user_id)->first();

                $user->notify(new OrderSuccess($order));
            }

            if ($callback->isExpire()) {
                Order::where('code', $order->id)->update([
                    'payment_status' => 3,
                    'status' => 'expired',
                ]);
            }

            if ($callback->isCancelled()) {
                Order::where('code', $order->id)->update([
                    'payment_status' => 4,
                    'status' => 'cancelled',
                ]);
            }

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Notifikasi berhasil diproses',
                ]);
        } else {
            return response()
                ->json([
                    'error' => true,
                    'message' => 'Signature key tidak terverifikasi',
                ], 403);
        }
    }
}
