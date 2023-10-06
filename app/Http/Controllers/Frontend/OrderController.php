<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderCanceledNotification;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::where('user_id', Auth::user()->id)
                ->with('schedule')
                ->where(function ($query) use ($request) {
                    $query->where('code', 'like', '%' . $request->keyword . '%')
                        ->orWhere('total', 'like', '%' . $request->keyword . '%');
                })
                ->whereHas('schedule', function ($query) use ($request) {
                    $query->where('route', 'like', '%' . $request->route . '%');
                })
                ->where('status', 'like', '%' . $request->status . '%')
                ->paginate(10);

            return view('pages.frontend.orders.list', compact('orders'));
        }
        return view('pages.frontend.orders.index');
    }

    public function show(Order $order)
    {
        return view('pages.frontend.orders.detail', compact('order'));
    }

    public function cancel(Order $order)
    {
        $order->status = 'canceled';
        $order->save();
        $admin = User::find(1);
        $admin->notify(new OrderCanceledNotification($order));

        return response()->json([
            'status' => 'success',
            'message' => 'Pesanan berhasil dibatalkan',
        ]);
    }
}
