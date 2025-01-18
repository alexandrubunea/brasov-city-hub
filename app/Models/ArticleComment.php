<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleCommentFactory> */
    use HasFactory;

    protected $fillable = ['content', 'news_article_id'];

    public function article()
    {
        return $this->belongsTo(NewsArticle::class, 'news_article_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    } 
}
