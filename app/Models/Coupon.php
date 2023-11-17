<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'code',
        'discount',
        'limit',
        'used',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'used' => 'boolean',
        'limit' => 'integer',
        'discount' => 'integer',
    ];

    /**
     * Get the user that owns the Coupon
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    // hateoas
    /**
     * The accessors to append to the model's array form.
     */
    protected $appends = ['links'];

    /**
     * Get the links attribute.
     */
    public function getLinksAttribute(): array
    {
        $baseUri = '/api/coupons/' . $this->id;

        return [
            'self' => [
                'href' => $baseUri,
                'method' => 'GET',
                'type' => 'application/json',
                'description' => 'Get coupon detail'
            ],
            'update' => [
                'href' => $baseUri,
                'method' => 'PUT',
                'type' => 'application/json',
                'description' => 'Update coupon detail'
            ],
            'delete' => [
                'href' => $baseUri,
                'method' => 'DELETE',
                'type' => 'application/json',
                'description' => 'Delete coupon'
            ],
        ];
    }
}
