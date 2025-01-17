<?php

namespace App\Policies;

use App\Models\NewsArticle;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NewsArticlePolicy
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
    public function view(User $user, NewsArticle $newsArticle): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('news_creator');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, NewsArticle $newsArticle): bool
    {
        return $user->hasRole('news_moderator') || $newsArticle->user() == $user;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, NewsArticle $newsArticle): bool
    {
        return $user->hasRole('news_moderator') || $newsArticle->user() == $user;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, NewsArticle $newsArticle): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, NewsArticle $newsArticle): bool
    {
        return false;
    }
}
