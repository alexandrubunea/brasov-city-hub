<?php

namespace App\Livewire\Admin\RolesManager;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Role as RoleModel;

class Role extends Component
{
    use LivewireAlert;

    public RoleModel $role;

    public string $initial_role_name;
    public string $role_name;
    public bool $news_creator;
    public bool $news_moderator;
    public bool $discussions_creator;
    public bool $discussions_moderator;
    public bool $users_moderator;
    public bool $roles_moderator;

    protected $rules = [
        'role_name' => 'required|uppercase|unique:roles,role_name|max:32',

        'news_creator' => 'boolean',
        'news_moderator' => 'boolean',

        'discussions_moderator' => 'boolean',
        'discussions_creator' => 'boolean',

        'users_moderator' => 'boolean',

        'roles_moderator' => 'boolean'
    ];

    public function mount()
    {
        $this->initial_role_name = $this->role['role_name'];
        $this->role_name = $this->role['role_name'];
        $this->news_creator = $this->role['news_creator'];
        $this->news_moderator = $this->role['news_moderator'];
        $this->discussions_creator = $this->role['discussions_creator'];
        $this->discussions_moderator = $this->role['discussions_moderator'];
        $this->users_moderator = $this->role['users_moderator'];
        $this->roles_moderator = $this->role['roles_moderator'];
    }

    public function render()
    {
        return view('livewire.admin.roles-manager.role');
    }

    public function updateRole()
    {
        $this->role['role_name'] = strtoupper($this->role['role_name']);

        $rules = $this->rules;
        if ($this->role_name === $this->initial_role_name)
            unset($rules['role_name']);

        $validated = $this->validate($rules);

        $this->role->update($validated);
        $this->initial_role_name = $this->role_name;

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

    public function deleteRole()
    {
        $this->role->delete();

        $this->alert(
            'success',
            'Successful Operation',
            [
                'text' => 'The role has been deleted.',
                'toast' => false,
                'position' => 'center',
                'timer' => 2000,
            ]
        );

        $this->dispatch('refreshList')->to(RolesList::class);
    }
}
