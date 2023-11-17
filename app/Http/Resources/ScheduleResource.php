<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
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
            'car' => $this->whenLoaded('car', function () {
                return new CarResource($this->car);
            }),
            'route' => $this->route,
            'departure_time' => $this->departure_time,
            'arrival_time' => $this->arrival_time,
            'price' => $this->price,
            'available_seats' => $this->available_seats,
            'links' => $this->links,
        ];
    }
}
