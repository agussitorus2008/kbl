<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            'driver' => $this->whenLoaded('driver') ? new DriverResource($this->driver) : null,
            'capacity' => $this->capacity,
            'car_number' => $this->car_number,
            'plate_number' => $this->plate_number,
            'image' => $this->image ? asset('images/cars/' . $this->image) : null,
            'type' => $this->type,
            'links' => $this->links,
        ];
    }
}
