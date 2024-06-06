<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;

class CreateSnapTokenService extends Midtrans
{
    protected $order;

    public function __construct($order)
    {
        parent::__construct();

        $this->order = $order;
    }

    public function getSnapToken()
    {
        $params = [
            'transaction_details' => [
                'order_id' => $this->order->code,
                'gross_amount' => $this->order->total_price,
            ],
            'item_details' => [
                [
                    'id' => $this->order->id,
                    'price' => $this->order->total,
                    'quantity' => $this->order->orderDetails->count(),
                    'name' => 'Tiket' . $this->order->schedule->route,
                ]
            ],
            'customer_details' => [
                'first_name' => $this->order->user->name,
                'email' => $this->order->user->email,
                'phone' => $this->order->user->phone,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}
