<?php

namespace App\Livewire\Admin\RolesManager;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Role as RoleModel;

class Role extends Component
{
    use LivewireAlert;

    public int $role_id;
    public string $role_name;
    public bool $news_creator;
    public bool $news_moderator;
    public bool $discussions_creator;
    public bool $discussions_moderator;
    public bool $users_moderator;
    public bool $roles_moderator;

    public string $initial_role_name;

    protected $rules = [
        'role_name' => 'required|uppercase|unique:roles,role_name|max:32',

        'news_creator' => 'boolean',
        'news_moderator' => 'boolean',

        'discussions_moderator' => 'boolean',
        'discussions_creator' => 'boolean',

        'users_moderator' => 'boolean',

        'roles_moderator' => 'boolean'
    ];

    public function mount(int $role_id, string $role_name, bool $news_creator, bool $news_moderator, bool $discussions_creator, bool $discussions_moderator, bool $users_moderator, bool $roles_moderator)
    {
        $this->role_id = $role_id;
        $this->role_name = $role_name;
        $this->news_creator = $news_creator;
        $this->news_moderator = $news_moderator;
        $this->discussions_creator = $discussions_creator;
        $this->discussions_moderator = $discussions_moderator;
        $this->users_moderator = $users_moderator;
        $this->roles_moderator = $roles_moderator;

        $this->initial_role_name = $role_name;
    }

    public function render()
    {
        return view('livewire.admin.roles-manager.role');
    }

    public function updateRole()
    {
        $this->role_name = strtoupper($this->role_name);

        $rules = $this->rules;
        if ($this->role_name === $this->initial_role_name)
            unset($rules['role_name']);

        $validated = $this->validate($rules);

        $role = RoleModel::find($this->role_id);
        if ($role == null) {
            $this->alert(
                'error',
                'Operation Failed',
                [
                    'toast' => false,
                    'position' => 'center',
                    'timer' => 5000,
                    'text' => 'This role no longer exists in the database.',
                    'showConfirmButton' => true,
                ]
            );
            return;
        }

        $role->update($validated);
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
        $role = RoleModel::find($this->role_id);
        if ($role == null) {
            $this->alert(
                'error',
                'Operation Failed',
                [
                    'toast' => false,
                    'position' => 'center',
                    'timer' => 5000,
                    'text' => 'This role no longer exists in the database.',
                    'showConfirmButton' => true,
                ]
            );
            return;
        }

        $role->delete();

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
