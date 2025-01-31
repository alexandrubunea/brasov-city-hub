<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'password'
    ];

    public function liked_discussions()
    {
        return $this->hasMany(Discussion::class);
    }

    public function liked_articles()
    {
        return $this->hasMany(NewsLikes::class);
    }

    public function comments_on_articles()
    {
        return $this->hasMany(ArticleComment::class);
    }
    
    public function newsArticles()
    {
        return $this->hasMany(NewsArticle::class);
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }

    public function hasRole(string $attribute)
    {
        return $this->roles()->where($attribute, true)->exists();
    }
}
