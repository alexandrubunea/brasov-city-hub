<?php

namespace App\Livewire\News;

use Livewire\Component;
use App\Models\NewsArticle as NewsArticleModel;
use App\Models\NewsLikes as NewsLikesModel;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CompleteNewsArticle extends Component
{
    use LivewireAlert;

    public int $id;
    public string $title;
    public string $content;
    public string $author;
    public string $created_at;
    public string $updated_at;
    public int $likes;
    public int $comments;

    public bool $can_modify;
    public NewsLikesModel|null $liked_article = null;

    public bool $logged_in = false;

    public NewsArticleModel $article;

    protected $listeners = [
        'deleteArticleConfirmed'
    ];

    public function mount(int $article_id)
    {
        $article = NewsArticleModel::findOrFail($article_id);

        $this->id = $article->id;
        $this->title = $article->title;
        $this->author = $article->user->first_name . ' ' . $article->user->last_name;
        $this->likes = $article->likes()->count();
        $this->comments = $article->comments->count();
        $this->content = $article->content;
        $this->created_at = Carbon::parse($article->created_at)->format('d F Y H:i');
        $this->updated_at = Carbon::parse($article->updated_at)->format('d F Y H:i');

        $this->article = $article;

        if (!auth()->check()) {
            $this->can_modify = false;
            $this->liked_article = null;
            return;
        }

        $this->logged_in = true;

        $article_owner = auth()->user() == $article->user && auth()->user()->hasRole('news_creator');
        $article_moderator = auth()->user()->hasRole('news_moderator');
        $this->can_modify = ($article_owner || $article_moderator) && !auth()->user()->banned;

        $this->liked_article = NewsLikesModel::where('user_id', auth()->user()->id)
            ->where('news_article_id', $article_id)
            ->first();
    }

    public function deleteArticle()
    {
        if (!$this->can_modify)
            return;

        $this->alert(
            'question',
            'Are you sure?',
            [
                'toast' => false,
                'position' => 'center',
                'timer' => null,
                'text' => 'Do you really want to delete this article? This action is not reversible',
                'showConfirmButton' => true,
                'showCancelButton' => true,
                'confirmButtonText' => 'Yes',
                'cancelButtonText' => 'No',
                'onConfirmed' => 'deleteArticleConfirmed'
            ]
        );
    }

    public function deleteArticleConfirmed()
    {
        if (!$this->can_modify)
            return;

        $this->article->delete();

        $this->alert(
            'success',
            'Successful Operation',
            [
                'text' => 'The article has been deleted.',
                'toast' => false,
                'position' => 'center',
                'timer' => 3000,
                'allowOutsideClick' => false,
            ]
        );
        $this->dispatch('articleDeleted')->self();
    }

    public function clickHeartButton()
    {
        if (!$this->logged_in)
            return;

        if ($this->liked_article == null)
            $this->liked_article = NewsLikesModel::create(['user_id' => auth()->user()->id, 'news_article_id' => $this->id]);
        else {
            $this->liked_article->delete();
            $this->liked_article = null;
        }

        $this->likes = $this->article->likes->count();
    }

    public function render()
    {
        return view('livewire.news.complete-news-article');
    }
}
