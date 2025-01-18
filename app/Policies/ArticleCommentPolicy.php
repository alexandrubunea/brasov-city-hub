<?php

namespace App\Policies;

use App\Models\ArticleComment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticleCommentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ArticleComment $articleComment): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->banned == false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ArticleComment $articleComment): bool
    {
        return $user->banned == false && $user == $articleComment->user;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ArticleComment $articleComment): bool
    {
        return $user == $articleComment->user || $user->hasRole('news_moderator,user_moderator');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ArticleComment $articleComment): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ArticleComment $articleComment): bool
    {
        return false;
    }
}
