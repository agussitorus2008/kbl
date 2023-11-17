<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->whenLoaded('user', function () {
                return new UserResource($this->user);
            }),
            'schedule' => $this->whenLoaded('schedule', function () {
                return new ScheduleResource($this->schedule);
            }),
            'coupon' => $this->whenLoaded('coupon', function () {
                return new CouponResource($this->coupon);
            }),
            'code' => $this->code,
            'total' => $this->total,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'order_details' => $this->whenLoaded('orderDetails', function () {
                return new OrderDetailCollection($this->orderDetails);
            }),
            'links' => $this->links,
        ];
    }
}
