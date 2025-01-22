<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    /** @use HasFactory<\Database\Factories\DiscussionFactory> */
    use HasFactory;

    protected $fillable = [
        'content',
        'cultural_event',
        'sport_event',
        'movie_night',
        'party',
        'show',
        'concert',
        'other'
    ];

    public function user()
    { 
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(DiscussionLikes::class, 'discussion_id');
    }
}
