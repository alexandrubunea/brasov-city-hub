<?php

namespace App\Livewire\News;

use Livewire\Component;

class NewsArticle extends Component
{
    public int $id;
    public string $title;
    public string $content;
    public string $author;
    public int $likes;
    public string $created_on;
    public string $updated_on;

    public function mount(int $id, string $title, string $content, string $author, int $likes, string $created_on, string $updated_on)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = strip_tags($content);
        $this->author = $author;
        $this->likes = $likes;
        $this->created_on = $created_on;
        $this->updated_on = $updated_on;
    }

    public function render()
    {
        return view('livewire.news.news-article');
    }
}
