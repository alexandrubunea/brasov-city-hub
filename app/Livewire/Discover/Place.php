<?php

namespace App\Livewire\Discover;

use Livewire\Component;

class Place extends Component
{
    public array $attraction;

    public function render()
    {
        return view('livewire.discover.place');
    }
}
