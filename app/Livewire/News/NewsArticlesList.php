<?php

namespace App\Livewire\News;

use Livewire\Component;
use App\Models\NewsArticle as NewsArticleModel;

use Illuminate\Support\Str;
use Carbon\Carbon;

class NewsArticlesList extends Component
{
    public string $sort;
    public bool $is_news_creator;
    public $news_articles_db;
    public $news_articles;

    public function mount()
    {
        $this->sort = 'hotness';
        $this->is_news_creator = auth()->user()->hasRole('news_creator');
        $this->loadArticles();
        $this->news_articles = $this->news_articles_db;
    }

    public function render()
    {
        return view('livewire.news.news-articles-list');
    }

    protected function loadArticles()
    {
        $articles = NewsArticleModel::with(['user', 'likes'])
            ->get()
            ->map(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'content' => Str::limit($article->content, 1000),
                    'user_name' => $article->user->first_name . ' ' . $article->user->last_name,
                    'likes_count' => $article->likes->count(),
                    'created_on' => Carbon::parse($article->created_at)->format('d F Y H:i'),
                    'updated_on' => Carbon::parse($article->updated_at)->format('d F Y H:i'),
                ];
            });
        $this->news_articles_db = $articles;
    }
}
