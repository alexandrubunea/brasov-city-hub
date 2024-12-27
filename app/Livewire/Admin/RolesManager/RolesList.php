<?php

namespace App\Livewire\Admin\RolesManager;

use Livewire\Component;
use App\Models\Role as RoleModel;
use Livewire\Attributes\On;

class RolesList extends Component
{
    public $roles;
    
    public function mount()
    {
        $this->loadRoles();
    }

    private function loadRoles()
    {
        $this->roles = RoleModel::orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.admin.roles-manager.roles-list');
    }

    #[On('refreshList')]
    public function refreshList()
    {
        $this->loadRoles();
    }
}
