<?php

namespace App\Livewire\Discussions;

use Livewire\Component;

class Discussions extends Component
{
    public string $order_by;

    public function mount()
    {
        $this->order_by = 'hotness';
    }

    public function render()
    {
        return view('livewire.discussions.discussions');
    }

    public function setOrderBy(string $order)
    {
        if (!($order == 'hotness' || $order == 'most_liked' || $order == 'latest'))
            return;

        $this->order_by = $order;
    }
}
