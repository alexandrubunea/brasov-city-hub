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

    public function newsArticles()
    {
        return $this->hasMany(NewsArticle::class);
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
