<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected static function booted()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->sent_by = auth()->id();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_id',
        'message',
        'sent_by',
        'sent_to',
    ];
}
