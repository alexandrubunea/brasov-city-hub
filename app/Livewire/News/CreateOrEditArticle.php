<?php

namespace App\Livewire\News;

use Livewire\Component;
use Livewire\Attributes\On;

class CreateOrEditArticle extends Component
{
    public string $mode;
    public string $author;
    public string $created_at;
    public string $updated_at;
    public string $title;
    public string $content;
    public int $id;

    public function mount(string $mode)
    {        
        $this->mode = $mode;

        if ($this->mode == 'create') {
            $this->author = '';
            $this->created_at = '';
            $this->updated_at = '';
            $this->content = '';
        }
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
        $this->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:3',
        ]);

        auth()->user()->newsArticles()->create([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        return redirect()->to(route('news.view'));
    }

    protected function updateArticle()
    {
        // To be implemented...
    }
}
