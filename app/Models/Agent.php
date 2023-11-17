<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'city',
        'address',
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
        $baseUri = '/api/agents/' . $this->id;

        return [
            'self' => [
                'href' => $baseUri,
                'method' => 'GET',
                'type' => 'application/json',
                'description' => 'Get agent detail'
            ],
            'update' => [
                'href' => $baseUri,
                'method' => 'PUT',
                'type' => 'application/json',
                'description' => 'Update agent detail'
            ],
            'delete' => [
                'href' => $baseUri,
                'method' => 'DELETE',
                'type' => 'application/json',
                'description' => 'Delete agent'
            ],
        ];
    }
}
