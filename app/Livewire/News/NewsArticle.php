<?php

namespace App\Livewire\News;

use Livewire\Component;

class NewsArticle extends Component
{
    public array $news_article;
    
    public function mount(array $news_article)
    {
        $this->news_article = $news_article;
    }

    public function render()
    {
        return view('livewire.news.news-article');
    }
}
