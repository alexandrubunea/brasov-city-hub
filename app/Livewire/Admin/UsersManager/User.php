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
    public bool $banned;

    public function mount(int $user_id, string $first_name, string $last_name, string $email, string $username, bool $banned, string $created_at, string $updated_at, array $roles)
    {
        $this->user_id = $user_id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->username = $username;
        $this->roles = $roles;
        $this->banned = $banned;
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
            'banned' => $this->banned,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'roles' => $this->roles,
        ];
        $this->dispatch('loadUser', $user)->to(UserEditor::class);
    }

    #[On('refreshUser.{user_id}')]
    public function refreshUser($user)
    {
        if (isset($user['first_name']))
            $this->first_name = $user['first_name'];
        if (isset($user['last_name']))
            $this->last_name = $user['last_name'];
        if (isset($user['email']))
            $this->email = $user['email'];
        if (isset($user['username']))
            $this->username = $user['username'];
        if (isset($user['roles']))
            $this->roles = $user['roles'];
        if (isset($user['banned']))
            $this->banned = $user['banned'];
    }
}
