<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiscussionLikes extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'discussion_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function discussion()
    {
        return $this->belongsTo(Discussion::class, 'discussion_id');
    } 
}
