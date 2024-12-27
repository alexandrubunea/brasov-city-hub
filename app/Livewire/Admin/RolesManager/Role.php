<?php

namespace App\Livewire\Admin\RolesManager;

use Livewire\Component;

class Role extends Component
{
    public int $role_id;
    public string $role_name;
    public bool $news_creator;
    public bool $news_moderator;
    public bool $discussions_creator;
    public bool $discussions_moderator;
    public bool $users_moderator;
    public bool $roles_moderator;

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
    }

    public function render()
    {
        return view('livewire.admin.roles-manager.role');
    }
}
