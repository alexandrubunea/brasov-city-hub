<?php

namespace App\Livewire;

use Livewire\Component;

class Alert extends Component
{
    public string $title;
    public string $message;
    public string $bg_color;
    public string $symbol;

    public function mount(string $title, string $message, string $type)
    {
        $this->title = $title;
        $this->message = $message;

        if($type == 'error') {
            $this->bg_color = 'bg-red-500';
            $this->symbol = '<i class="fa-solid fa-triangle-exclamation"></i>';
        }
    }
    public function render()
    {
        return view('livewire.alert');
    }
}
