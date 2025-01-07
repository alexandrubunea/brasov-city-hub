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
    public bool $banned;

    public string $initial_first_name;
    public string $initial_last_name;
    public string $initial_email;
    public string $initial_username;
    public array $initial_roles;

    public $available_roles;
    public string $role_to_add;

    public bool $can_be_modified;

    protected $rules = [
        'first_name' => 'required|string|max:64',
        'last_name' => 'required|string|max:64',
        'username' => 'required|string|max:64',
        'email' => 'required|string|email|max:255|unique:users,email',
    ];

    public function mount()
    {
        $this->resetUserData();
        $this->user_loaded = false;
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
        $this->banned = $user['banned'];
        $this->created_at = $user['created_at'];
        $this->updated_at = $user['updated_at'];

        // Using array_column is O(n) but runs only once, making it more efficient than repeatedly checking with a loop in O(n).
        // This allows O(1) time complexity for checking if a user already has a specific role.
        $this->roles = array_column($user['roles'], null, 'id');
        
        $this->updateInitialValues();
        if ($this->user_id == auth()->user()->id) {
            $this->user_loaded = true;
            $this->can_be_modified = true;
            return;
        }

        $this->can_be_modified = true;
        foreach($this->roles as $role) {
            if ($role['roles_moderator'] == 1) {
                $this->can_be_modified = false;
            }
        }

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

        unset($this->roles[$role_id]);
    }

    public function changeBannedStatus()
    {
        $this->banned = !$this->banned;
        $user = UserModel::find($this->user_id);
        $user->banned = $this->banned;
        $user->save();
        $this->dispatch("refreshUser.{$this->user_id}", user: ['banned' => $this->banned])->to(User::class);
    }

    public function clearAllRoles()
    {
        if (sizeof($this->roles) == 0)
            return;
        
        if ($this->can_be_modified == false)
            return;

        $this->roles = [];

        $user = UserModel::find($this->user_id);
        $this->updateRoles($user);

        $this->dispatch("refreshUser.{$this->user_id}", user: ['roles' => $this->roles])->to(User::class);
        $this->alert(
            'success',
            'Successful Operation',
            [
                'text' => 'All roles have been removed from this user.',
                'toast' => false,
                'position' => 'center',
                'timer' => 2000,
            ]
        );
    }

    public function updateUser()
    {
        if ($this->can_be_modified == false)
            return;

        $rules = $this->rules;

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

        $this->updateRoles($user);

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
        
        $this->updateInitialValues();

        $this->dispatch("refreshUser.{$this->user_id}", user: $user_data)->to(User::class);

        $this->alert(
            'success',
            'Successful Operation',
            [
                'text' => 'The user have been updated.',
                'toast' => false,
                'position' => 'center',
                'timer' => 2000,
            ]
        );
    }

    protected function updateRoles(UserModel $user)
    {
        if ($this->can_be_modified == false)
            return;

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
    }

    protected function updateInitialValues()
    {
        $this->initial_first_name = $this->first_name;
        $this->initial_last_name = $this->last_name;
        $this->initial_email = $this->email;
        $this->initial_username = $this->username;
        $this->initial_roles = $this->roles;
    }
}
