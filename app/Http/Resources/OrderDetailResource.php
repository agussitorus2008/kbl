<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
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
            'order' => $this->when($this->order, new OrderResource($this->order)),
            'order_id' => $this->order_id,
            'seat_id' => $this->seat_id,
            'links' => $this->links,
        ];
    }
}
