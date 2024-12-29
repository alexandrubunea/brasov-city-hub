<?php

namespace App\Livewire\Admin\UsersManager;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Role;

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
    public bool $roles_moderator = false;
    public array $roles_color = [];
    public $available_roles = [];
    public string $role_to_add = '';

    public function mount()
    {
        $this->roles_moderator = auth()->user()->hasRole('roles_moderator');
        $this->available_roles = Role::orderBy('role_name', 'asc')->get()->keyBy('id');
    }

    public function render()
    {
        return view('livewire.admin.users-manager.user-editor');
    }

    #[On('loadUser')]
    public function loadUser($user)
    {
        if ($this->user_id == $user['id'])
            return;

        $this->user_id = $user['id'];
        $this->first_name = $user['first_name'];
        $this->last_name = $user['last_name'];
        $this->email = $user['email'];
        $this->username = $user['username'];
        $this->created_at = $user['created_at'];
        $this->updated_at = $user['updated_at'];

        // Using array_column is O(n) but runs only once, making it more efficient than repeatedly checking with a loop in O(n).
        // This allows O(1) time complexity for checking if a user already has a specific role.
        $this->roles = array_column($user['roles'], null, 'id');

        $this->generateRolesColor();

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
        $this->role_to_add = '';
    }

    public function closeUser()
    {
        $this->resetUserData();
        $this->user_loaded = false;
    }

    public function addRole()
    {
        if ($this->role_to_add == -1)
            return;

        if (isset($this->roles[$this->role_to_add]))
            return;

        array_push($this->roles, $this->available_roles[$this->role_to_add]);
        $this->generateRolesColor();
    }

    public function removeRole(int $role_id)
    {
        // To be implemented... 
    }

    public function updateUser() 
    {
        // To be implemented...
    }

    private function generateRolesColor()
    {
        // TODO: Make this to expand & shrink based on $this->roles size.
        if (sizeof($this->roles)) {
            // Note: if more colors are added, add them to the safeList in tailwind.config.js too!
            $colors = ['bg-red-700', 'bg-emerald-700', 'bg-indigo-500', 'bg-sky-500', 'bg-teal-700', 'bg-pink-700'];
            $random = array_rand($colors, sizeof($this->roles));
            $this->roles_color = array_map(fn($index) => $colors[$index], (array) $random);
        }
    }
}
