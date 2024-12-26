<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Role;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class RoleCreator extends Component
{
    use LivewireAlert;

    public string $role_name;
    public bool $news_creator = false;
    public bool $news_moderator = false;
    public bool $discussions_creator = false;
    public bool $discussions_moderator = false;
    public bool $users_moderator = false;
    public bool $roles_moderator = false;

    protected $rules = [
        'role_name' => 'required|unique:roles,role_name|max:32',

        'news_creator' => 'boolean',
        'news_moderator' => 'boolean',

        'discussions_moderator' => 'boolean',
        'discussions_creator' => 'boolean',

        'users_moderator' => 'boolean',

        'roles_moderator' => 'boolean'
    ];

    public function render()
    {
        return view('livewire.admin.role-creator');
    }

    public function createRoleForm()
    {
        $validated = $this->validate();

        Role::create($validated);

        $this->reset(['role_name', 'news_creator', 'news_moderator', 'discussions_creator', 'discussions_moderator', 'users_moderator', 'roles_moderator']);

        $this->alert(
            'success',
            'Successful Operation',
            [
                'text' => 'The role has been created.',
                'toast' => false,
                'position' => 'center',
                'timer' => 2000,
            ]
        );
    }
}
