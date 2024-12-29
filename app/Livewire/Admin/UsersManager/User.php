<?php

namespace App\Livewire\Admin\UsersManager;

use Livewire\Component;
use Livewire\Attributes\On;

class User extends Component
{
    public int $user_id;
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $username;
    public string $created_at;
    public string $updated_at;
    public array $roles;

    public function mount(int $user_id, string $first_name, string $last_name, string $email, string $username, string $created_at, string $updated_at, array $roles)
    {
        $this->user_id = $user_id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->username = $username;
        $this->roles = $roles;
        $this->created_at = date('d M Y', strtotime($created_at));
        $this->updated_at = date('d M Y', strtotime($updated_at));
    }

    public function render()
    {
        return view('livewire.admin.users-manager.user');
    }

    public function clickUser()
    {
        $user = [
            'id' => $this->user_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'username' => $this->username,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'roles' => $this->roles,
        ];
        $this->dispatch('loadUser', $user)->to(UserEditor::class);
    }

    #[On('refreshRoles.{user_id}')] 
    public function refreshRoles($roles)
    {
        $this->roles = $roles;
    }
}
