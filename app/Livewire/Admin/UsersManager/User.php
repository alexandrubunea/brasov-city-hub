<?php

namespace App\Livewire\Admin\UsersManager;

use Livewire\Component;
use Livewire\Attributes\On;

class User extends Component
{
    public array $user;
    public int $user_id;

    public function mount()
    {
        $this->user_id = $this->user['id'];
    }

    public function render()
    {
        return view('livewire.admin.users-manager.user');
    }

    public function clickUser()
    {
        $this->dispatch('loadUser', $this->user)->to(UserEditor::class);
    }

    #[On('refreshUser.{user_id}')]
    public function refreshUser($user)
    {
        foreach ($user as $key => $value) {
            if (isset($user[$key])) {
                $this->user[$key] = $value;
            }
        }
    }
}
