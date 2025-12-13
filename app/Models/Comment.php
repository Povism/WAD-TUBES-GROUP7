<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'body'
    ];

    public function forum()
    {
        // A Comment belongs to one Forum
        return $this->belongsTo(Forum::class);
    }

    /**
     * Get the user who authored the comment.
     */
    public function user()
    {
        // A Comment belongs to one User
        return $this->belongsTo(User::class);
    }
}
