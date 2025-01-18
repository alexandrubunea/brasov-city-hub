<?php

namespace App\Livewire\News;

use App\Models\ArticleComment;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;

class Comments extends Component
{
    public array $comments_db;
    public array $comments;

    public string $content;

    public int $current_page = 1;
    public int $results_on_page = 20;
    public int $number_of_pages;

    public int $article_id;

    public function mount(int $article_id)
    {
        $this->article_id = $article_id;
        $this->loadComments();
    }

    public function render()
    {
        return view('livewire.news.comments');
    }

    #[On('refreshComments')]
    public function refreshComments()
    {
        $this->loadComments();
    }

    public function addComment()
    {
        $validator = $this->validate([
            'content' => 'required|min:3|max:500',
        ]);

        auth()->user()->comments_on_articles()->create($validator + ['news_article_id' => $this->article_id]);
        $this->content = '';
        $this->loadComments();
    }

    public function firstPage()
    {
        $this->current_page = 1;
        $this->loadCommentsPage();
    }

    public function lastPage()
    {
        $this->current_page = $this->number_of_pages;
        $this->loadCommentsPage();
    }

    public function nextPage()
    {
        if ($this->current_page >= $this->number_of_pages)
            return;

        $this->current_page += 1;
        $this->loadCommentsPage();
    }

    public function prevPage()
    {
        if ($this->current_page <= 1)
            return;

        $this->current_page -= 1;
        $this->loadCommentsPage();
    }

    protected function loadCommentsPage()
    {
        $this->number_of_pages = ceil(count($this->comments_db) / $this->results_on_page);
        $start = $this->results_on_page * ($this->current_page - 1);
        $this->comments = array_slice($this->comments_db, $start, $this->results_on_page);
    }

    protected function loadComments()
    {
        $this->comments_db = ArticleComment::with('user')
            ->where('news_article_id', $this->article_id)
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'author' => $comment->user->first_name . ' ' . $comment->user->last_name,
                    'content' => $comment->content,
                    'created_at' => Carbon::parse($comment->created_at)->format('d F Y H:i'),
                    'updated_at' => Carbon::parse($comment->updated_at)->format('d F Y H:i'),
                ];
            })->toArray();
        $this->loadCommentsPage();
    }
}
