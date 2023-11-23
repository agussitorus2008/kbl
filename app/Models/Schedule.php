<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::creating(function (Schedule $schedule) {
            $schedule->available_seats = $schedule->car->capacity;
        });
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'car_id',
        'route',
        'departure_time',
        'arrival_time',
        'price',
        'available_seats',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     */
    protected $appends = ['links'];

    /**
     * Get the links attribute.
     */
    public function getLinksAttribute(): array
    {
        $baseUri = '/api/schedules/' . $this->id;

        return [
            'self' => [
                'href' => $baseUri,
                'method' => 'GET',
                'type' => 'application/json',
                'description' => 'Get schedule detail'
            ],
            'update' => [
                'href' => $baseUri,
                'method' => 'PUT',
                'type' => 'application/json',
                'description' => 'Update schedule detail'
            ],
            'delete' => [
                'href' => $baseUri,
                'method' => 'DELETE',
                'type' => 'application/json',
                'description' => 'Delete schedule detail'
            ],
        ];
    }

    /**
     * Get the car that owns the Schedule
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * Get all of the orders for the Schedule
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class);
    }
}
