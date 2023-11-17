<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
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
            'code' => $this->code,
            'discount' => $this->discount,
            'limit' => $this->limit,
            'used' => $this->used,
            'links' => $this->links,
        ];
    }
}
