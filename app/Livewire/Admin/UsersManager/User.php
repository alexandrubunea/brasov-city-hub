<?php

namespace App\Livewire\Admin\UsersManager;

use Livewire\Component;

class User extends Component
{
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $username;
    public string $created_at;

    public function mount(string $first_name, string $last_name, string $email, string $username, string $created_at)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->username = $username;
        $this->created_at = date('d M Y', strtotime($created_at));
    }

    public function render()
    {
        return view('livewire.admin.users-manager.user');
    }
}
