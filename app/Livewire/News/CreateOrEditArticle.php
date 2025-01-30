<?php

namespace App\Livewire\News;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\NewsArticle as NewsArticleModel;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateOrEditArticle extends Component
{
    use LivewireAlert;

    public string $mode;
    public string $author;
    public string $created_at;
    public string $updated_at;
    public string $title;
    public string $content;
    public int $id;

    public bool $can_modify = false;

    public NewsArticleModel|null $article;

    public function mount(string $mode, int $id = -1)
    {
        $this->mode = $mode;

        if ($this->mode == 'create') {
            $this->author = '';
            $this->created_at = '';
            $this->updated_at = '';
            $this->content = '';
        } else {
            $this->article = NewsArticleModel::findOrFail($id);

            $this->author = $this->article->user->first_name . ' ' . $this->article->user->last_name;
            $this->created_at = Carbon::parse($this->article->created_at)->format('d F Y H:i');
            $this->updated_at = Carbon::parse($this->article->updated_at)->format('d F Y H:i');
            $this->title = $this->article->title;
            $this->content = $this->article->content;

            $article_owner = auth()->user() == $this->article->user && auth()->user()->hasRole('news_creator');
            $article_moderator = auth()->user()->hasRole('news_moderator');
            $this->can_modify = $article_owner || $article_moderator;
        }

        if (auth()->check() && auth()->user()->banned)
            $this->redirect(route('news.view'));
    }

    public function render()
    {
        return view('livewire.news.create-or-edit-article');
    }

    public function saveArticle()
    {
        if ($this->mode == 'create')
            $this->createArticle();
        else
            $this->updateArticle();
    }

    #[On('editor-update-content')]
    public function updateContent(string $content)
    {
        $this->content = $content;
    }

    protected function createArticle()
    {
        $validator = $this->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:3',
        ]);

        auth()->user()->newsArticles()->create($validator);

        return redirect()->to(route('news.view'));
    }

    protected function updateArticle()
    {
        if (!$this->can_modify)
            return;

        $validator = $this->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:3',
        ]);
        
        $this->article->update($validator);

        $this->alert(
            'success',
            'Successful Operation',
            [
                'text' => 'The changes made to the article have been saved.',
                'toast' => false,
                'position' => 'center',
                'timer' => 3000,
            ]    
        );
    }
}
