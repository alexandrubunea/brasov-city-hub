<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLikes extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'news_article_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(NewsArticle::class, 'news_article_id');
    }
}
