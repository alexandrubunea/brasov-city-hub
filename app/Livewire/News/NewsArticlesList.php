<?php

namespace App\Livewire\News;

use Livewire\Component;
use App\Models\NewsArticle as NewsArticleModel;

use Illuminate\Support\Str;
use Carbon\Carbon;

class NewsArticlesList extends Component
{
    public string $sort;
    public string $order;
    public bool $is_news_creator;
    public $news_articles_db;
    public $news_articles;
    public string $search_bar;

    public int $current_page = 1;
    public int $results_on_page = 10;
    public int $number_of_pages;

    public function mount()
    {
        $this->sort = 'hot';
        $this->search_bar = '';
        $this->order = 'desc';
        $this->is_news_creator = auth()->check() && auth()->user()->hasRole('news_creator') && !auth()->user()->banned;
        $this->loadArticles();
    }

    public function render()
    {
        return view('livewire.news.news-articles-list');
    }

    public function submitSearch()
    {
        $this->loadArticles();
    }

    public function firstPage()
    {
        $this->current_page = 1;
        $this->loadArticlesPage();
    }

    public function lastPage()
    {
        $this->current_page = $this->number_of_pages;
        $this->loadArticlesPage();
    }

    public function nextPage()
    {
        if ($this->current_page >= $this->number_of_pages)
            return;

        $this->current_page += 1;
        $this->loadArticlesPage();
    }

    public function prevPage()
    {
        if ($this->current_page <= 1)
            return;

        $this->current_page -= 1;
        $this->loadArticlesPage();
    }

    protected function loadArticlesPage()
    {
        $this->number_of_pages = ceil(count($this->news_articles_db) / $this->results_on_page);
        $start = $this->results_on_page * ($this->current_page - 1);
        $this->news_articles = array_slice($this->news_articles_db, $start, $this->results_on_page);
    }

    protected function loadArticles()
    {
        $query = NewsArticleModel::query();

        if (!empty($this->search_bar))
            $query->whereRaw('LOWER(title) LIKE ? ', ['%' . strtolower($this->search_bar) . '%']);

        switch ($this->sort) {
            case 'hot':
                $HOT_CONST = 1.0;
                $query->leftJoin('news_likes', 'news_likes.news_article_id', '=', 'news_articles.id')
                    ->leftJoin('article_comments', 'article_comments.news_article_id', '=', 'news_articles.id')
                    ->selectRaw('news_articles.*, 
                               (COUNT(news_likes.id) + COUNT(article_comments.id) - (EXTRACT(day FROM (CURRENT_DATE - news_articles.created_at)) * ?)) AS hotness', [$HOT_CONST])
                    ->groupBy('news_articles.id')
                    ->orderBy('hotness', $this->order);
                break;

            case 'likes':
                $query->leftJoin('news_likes', 'news_likes.news_article_id', '=', 'news_articles.id')
                    ->selectRaw('news_articles.*, COUNT(news_likes.id) AS likes_count')
                    ->groupBy('news_articles.id')
                    ->orderBy('likes_count', $this->order);
                break;

            case 'recent':
                $query->orderBy('created_at', $this->order);
                break;
        }

        $articles = $query->with(['user', 'likes'])
            ->get()
            ->map(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'content' => Str::limit(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($article->content))), 1000),
                    'author' => $article->user->first_name . ' ' . $article->user->last_name,
                    'likes' => $article->likes->count(),
                    'comments' => $article->comments->count(),
                    'created_at' => Carbon::parse($article->created_at)->format('d F Y H:i'),
                    'updated_at' => Carbon::parse($article->updated_at)->format('d F Y H:i'),
                ];
            })
            ->toArray();

        $this->news_articles_db = $articles;
        $this->loadArticlesPage();
    }
}
