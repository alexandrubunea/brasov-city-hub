<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'role_name',

        'news_creator',
        'news_moderator',

        'discussions_moderator',
        'discussions_creator',

        'users_moderator',

        'roles_moderator'
    ];
}
