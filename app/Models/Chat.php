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

    /**
     * The accessors to append to the model's array form.
     */
    protected $appends = ['links'];

    /**
     * Get the links attribute.
     */
    public function getLinksAttribute(): array
    {
        $baseUri = '/api/chats/' . $this->id;

        return [
            'self' => [
                'href' => $baseUri,
                'method' => 'GET',
                'type' => 'application/json',
                'description' => 'Get chat detail'
            ],
        ];
    }

    /**
     * Get the user that owns the Chat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sentBy()
    {
        return $this->belongsTo(User::class, 'sent_by')->withDefault();
    }

    /**
     * Get the user that owns the Chat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sentTo()
    {
        return $this->belongsTo(User::class, 'sent_to')->withDefault();
    }

    /**
     * Get the parent that owns the Chat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Chat::class, 'parent_id')->withDefault();
    }

    /**
     * Get all of the children for the Chat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Chat::class, 'parent_id');
    }
}
