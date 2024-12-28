<?php

namespace App\Livewire\Admin\UsersManager;

use Livewire\Component;
use Livewire\Attributes\On;

class UserEditor extends Component
{
    public bool $user_loaded = false;
    public int $user_id = 0;
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $username = '';
    public string $created_at = '';
    public string $updated_at = '';
    public array $roles = [];

    public function render()
    {
        return view('livewire.admin.users-manager.user-editor');
    }

    #[On('loadUser')]
    public function loadUser($user)
    {
        $this->user_id = $user['id'];
        $this->first_name = $user['first_name'];
        $this->last_name = $user['last_name'];
        $this->email = $user['email'];
        $this->username = $user['username'];
        $this->created_at = $user['created_at'];
        $this->updated_at = $user['updated_at'];
        $this->roles = $user['roles'];

        $this->user_loaded = true;
    }

    public function resetUserData()
    {
        $this->user_id = 0;
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->username = '';
        $this->created_at = '';
        $this->updated_at = '';
        $this->roles = [];
    }

    public function closeUser()
    {
        $this->resetUserData();
        $this->user_loaded = false;
    }
}
