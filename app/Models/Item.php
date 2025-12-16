<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'category',
        'description',
        'price',
        'condition',
        'eco_friendly',
        'status',
        'images',
    ];

    protected $casts = [
        'eco_friendly' => 'boolean',
        'images' => 'array',
        'price' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
