<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    // protected static function booted()
    // {
    //     parent::boot();

    //     static::creating(function ($order) {
    //         $order->code = 'ORDER-' . time();
    //         $order->user_id = auth()->user()->id;
    //     });
    // }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'schedule_id',
        'coupon_id',
        'code',
        'total',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total' => 'float',
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
        $baseUri = '/api/orders/' . $this->id;

        return [
            'self' => [
                'href' => $baseUri,
                'method' => 'GET',
                'type' => 'application/json',
                'description' => 'Get order detail'
            ],
            'update' => [
                'href' => $baseUri,
                'method' => 'PUT',
                'type' => 'application/json',
                'description' => 'Update order detail'
            ],
            'delete' => [
                'href' => $baseUri,
                'method' => 'DELETE',
                'type' => 'application/json',
                'description' => 'Delete order'
            ],
        ];
    }

    /**
     * Get the user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Get the schedule that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    /**
     * Get the coupon that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    /**
     * Get all of the orderDetails for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetails(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
}
