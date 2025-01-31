<?php

namespace App\Livewire\Admin\UsersManager;

use App\Models\Role;
use Livewire\Component;
use App\Models\User as UserModel;
use Carbon\Carbon;

class UsersList extends Component
{
    public array $roles;
    public $users;
    public $db_users;

    public string $first_name;
    public string $last_name;
    public string $username;
    public string $email;
    public string $role = 'all_roles';
    public string $order_by = 'created_at';
    public string $sort_by = 'asc';

    public int $current_page = 1;
    public int $results_on_page = 10;
    public int $number_of_pages;

    public function mount()
    {
        $this->roles = Role::orderBy('role_name', 'asc')->pluck('role_name')->toArray();
        $this->loadUsers();
    }

    public function render()
    {
        return view('livewire.admin.users-manager.users-list');
    }

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

        if ($this->role != 'all_roles')
            $query->whereHas('roles', function ($q) {
                $q->where('role_name', $this->role);
            });

        $this->db_users = $query->with('roles')
            ->orderBy($this->order_by, $this->sort_by)
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'username' => $user->username,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'roles' => $user->roles()->get()->toArray(),
                    'banned' => $user->banned,
                    'created_at' => Carbon::parse($user->created_at)->format('d F Y H:i'),
                    'updated_at' => Carbon::parse($user->updated_at)->format('d F Y H:i') 
                ];
            })
            ->toArray(); 

        $this->current_page = 1;
        $this->loadUsersPage();
    }

    public function loadUsersPage()
    {
        $this->number_of_pages = ceil(count($this->db_users) / $this->results_on_page);

        $start = $this->results_on_page * ($this->current_page - 1);
        $this->users = array_slice($this->db_users, $start, $this->results_on_page);
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
        $this->results_on_page = 10;

        $this->loadUsers();
    }

    public function firstPage()
    {
        $this->current_page = 1;
        $this->loadUsersPage();
    }

    public function lastPage()
    {
        $this->current_page = $this->number_of_pages;
        $this->loadUsersPage();
    }

    public function nextPage()
    {
        if ($this->current_page >= $this->number_of_pages)
            return;

        $this->current_page += 1;
        $this->loadUsersPage();
    }

    public function prevPage()
    {
        if ($this->current_page <= 1)
            return;

        $this->current_page -= 1;
        $this->loadUsersPage();
    }
}
