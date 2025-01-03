<?php

namespace App\Livewire\Admin\UsersManager;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Role;
use App\Models\User as UserModel;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UserEditor extends Component
{
    use LivewireAlert;

    public bool $roles_moderator;
    public bool $users_moderator;
    public bool $user_loaded;

    public int $user_id;
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $username;
    public string $created_at;
    public string $updated_at;
    public array $roles;

    public string $initial_first_name;
    public string $initial_last_name;
    public string $initial_email;
    public string $initial_username;
    public array $initial_roles;

    public $available_roles;
    public string $role_to_add;

    protected $rules = [
        'first_name' => 'required|string|max:64',
        'last_name' => 'required|string|max:64',
        'username' => 'required|string|max:64',
        'email' => 'required|string|email|max:255|unique:users,email',
    ];

    // TODO: Display the editor only for those who have a role with users_moderator = true
    // TODO: Make possible to remove a roles_moderator = true role from a user if that role wasn't given (pressed update) to him yet
    // TODO: Make it responsive

    public function mount()
    {
        $this->resetUserData();

        $this->roles_moderator = auth()->user()->hasRole('roles_moderator');
        $this->users_moderator = auth()->user()->hasRole('users_moderator');

        $this->available_roles = Role::orderBy('role_name', 'asc')->get()->toArray();
        $this->available_roles = array_column($this->available_roles, null, 'id');
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

        $this->initial_first_name = $this->first_name;
        $this->initial_last_name = $this->last_name;
        $this->initial_email = $this->email;
        $this->initial_username = $this->username;
        $this->initial_roles = $this->roles;

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

        $this->initial_first_name = '';
        $this->initial_last_name = '';
        $this->initial_username = '';
        $this->initial_email = '';
        $this->initial_roles = [];

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

        $this->roles[$this->role_to_add] = $this->available_roles[$this->role_to_add];
    }

    public function removeRole(int $role_id)
    {
        if (!isset($this->roles[$role_id]))
            return;

        if ($this->roles[$role_id]['roles_moderator'])
            return;

        unset($this->roles[$role_id]);
    }

    public function updateUser()
    {
        $rules = $this->rules;

        if ($this->users_moderator == false) {
            $this->first_name = $this->initial_first_name;
            $this->last_name = $this->initial_last_name;
            $this->email = $this->initial_email;
            $this->username = $this->initial_username;
        }

        if ($this->roles_moderator == false)
            $this->roles = $this->initial_roles;

        if ($this->first_name === $this->initial_first_name)
            unset($rules['first_name']);
        if ($this->last_name === $this->initial_last_name)
            unset($rules['last_name']);
        if ($this->username === $this->initial_username)
            unset($rules['username']);
        if ($this->email === $this->initial_email)
            unset($rules['email']);

        $user = UserModel::find($this->user_id);
        if ($user == null) {
            $this->alert(
                'error',
                'Operation Failed',
                [
                    'toast' => false,
                    'position' => 'center',
                    'timer' => 5000,
                    'text' => 'This user no longer exists in the database.',
                    'showConfirmButton' => true,
                ]
            );

            return;
        }

        $roles_to_add = [];
        foreach ($this->roles as $role) {
            if (!isset($this->initial_roles[$role['id']]))
                $roles_to_add[] = $role['id'];
        }

        $roles_to_remove = [];
        foreach ($this->initial_roles as $role) {
            if (!isset($this->roles[$role['id']]))
                $roles_to_remove[] = $role['id'];
        }

        if (sizeof($roles_to_add))
            $user->roles()->attach($roles_to_add);
        if (sizeof($roles_to_remove))
            $user->roles()->detach($roles_to_remove);

        if (sizeof($rules)) {
            $validated = $this->validate($rules);
            $user->update($validated);
        }

        $user_data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'email' => $this->email,
            'roles' => $this->roles
        ];

        $this->dispatch("refreshUser.{$this->user_id}", user: $user_data)->to(User::class);

        $this->alert(
            'success',
            'Successful Operation',
            [
                'text' => 'The role has been updated.',
                'toast' => false,
                'position' => 'center',
                'timer' => 2000,
            ]
        );
    }
}
