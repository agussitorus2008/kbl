<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'address',
        'image',
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
        $baseUri = '/api/drivers/' . $this->id;

        return [
            'self' => [
                'href' => $baseUri,
                'method' => 'GET',
                'type' => 'application/json',
                'description' => 'Get driver detail'
            ],
            'update' => [
                'href' => $baseUri,
                'method' => 'PUT',
                'type' => 'application/json',
                'description' => 'Update driver detail'
            ],
            'delete' => [
                'href' => $baseUri,
                'method' => 'DELETE',
                'type' => 'application/json',
                'description' => 'Delete driver'
            ],
        ];
    }

    /**
     * Get the car associated with the Driver
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function car()
    {
        return $this->hasOne(Car::class);
    }
}
