<?php

namespace App\Livewire;

use App\Models\ArticleComment;
use App\Models\Discussion;
use App\Models\NewsArticle;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Homepage extends Component
{
    public bool $is_users_moderator = false;
    public bool $is_roles_moderator = false;

    public string $users_count;
    public string $news_count;
    public string $discussions_count;
    public string $comments_count;

    public function mount()
    {
        if (auth()->check()) {
            $this->is_roles_moderator = auth()->user()->hasRole('roles_moderator');
            $this->is_users_moderator = auth()->user()->hasRole('users_moderator');
        }

        $cache = Cache::get('homepage_stats');
        if ($cache) {
            $this->users_count = $cache['users_count'];
            $this->news_count = $cache['news_count'];
            $this->discussions_count = $cache['discussions_count'];
            $this->comments_count = $cache['comments_count'];

            return;
        }

        $this->users_count = $this->humanReadableNumber(User::all()->count());
        $this->news_count = $this->humanReadableNumber(NewsArticle::all()->count());
        $this->discussions_count = $this->humanReadableNumber(Discussion::all()->count());
        $this->comments_count = $this->humanReadableNumber(ArticleComment::all()->count());

        $stats = [
            'users_count' => $this->users_count,
            'news_count' => $this->news_count,
            'discussions_count' => $this->discussions_count,
            'comments_count' => $this->comments_count
        ];

        Cache::put('homepage_stats', $stats, 28800);
    }

    public function render()
    {
        return view('livewire.homepage');
    }

    private function humanReadableNumber($number)
    {
        if ($number >= 1000000000) {
            return round($number / 1000000000, 1) . 'B';
        } elseif ($number >= 1000000) {
            return round($number / 1000000, 1) . 'M';
        } elseif ($number >= 1000) {
            return round($number / 1000, 1) . 'K';
        }

        return $number;
    }
}
