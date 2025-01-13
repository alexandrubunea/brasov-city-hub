<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class RichTextEditor extends Component
{
    use WithFileUploads;

    public $content = '';
    public $editorId;

    public function mount($initialContent = '')
    {
        $this->content = $initialContent;
        $this->editorId = 'editor-' . uniqid();
    }

    public function updateContent($content)
    {
        $this->content = $content;

        $this->dispatch('editor-update-content', content: $this->content);
    }

    public function render()
    {
        return view('livewire.rich-text-editor');
    }
}
