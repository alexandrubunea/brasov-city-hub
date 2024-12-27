<?php

namespace App\Livewire\Admin\UsersManager;

use App\Models\Role;
use Livewire\Component;
use App\Models\User as UserModel;

class UsersList extends Component
{
    public array $roles;
    public $users;

    public string $first_name;
    public string $last_name;
    public string $username;
    public string $email;
    public string $role = 'all_roles';
    public string $order_by = 'created_at';
    public string $sort_by = 'asc';

    public function loadUsers()
    {
        $query = UserModel::query();

        if (!empty($this->first_name))
            $query->whereRaw('LOWER(first_name) LIKE ?', ['%' . strtolower($this->first_name) . '%']);
        if (!empty($this->last_name))
            $query->whereRaw('LOWER(last_name) LIKE ?', ['%' . strtolower($this->last_name) . '%']);
        if (!empty($this->username))
            $query->whereRaw('LOWER(username) LIKE ?', ['%' . strtolower($this->username) . '%']);
        if (!empty($this->email))
            $query->whereRaw('LOWER(email) LIKE ?', ['%' . strtolower($this->email) . '%']);
         
        $this->users = $query->orderBy($this->order_by, $this->sort_by)->get();
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
        $this->loadUsers();
    }

    public function resetSearch()
    {
        $this->first_name = '';
        $this->last_name = '';
        $this->username = '';
        $this->email = '';
        $this->role = 'all_roles';
        $this->order_by = 'created_at';
        $this->sort_by = 'asc';        

        $this->loadUsers();
    }
}
