<?php

namespace App\Livewire\Admin\UsersManager;

use App\Models\Role;
use Livewire\Component;
use App\Models\User as UserModel;

class UsersList extends Component
{
    public array $roles;
    public $users;

    public function loadUsers()
    {
        $this->users = UserModel::orderBy('created_at', 'desc')->get();
    }

    public function mount()
    {
        $this->roles = Role::orderBy('role_name', 'asc')->pluck('role_name')->toArray();
        $this->loadUsers();
    }

    public function render()
    {
        return view('livewire.admin.users-manager.users-list');
    }

    public function searchUser()
    {

    }
}
