<?php

namespace Modules\Rbac\Livewire\RoleManagement;

use Illuminate\Support\Arr;
use Livewire\Attributes\On;
use Livewire\Component;
use Modules\Rbac\App\Models\ComRole;

class Form extends Component
{
    public array $tabs = [];

    public array $currentTab = [];

    public ComRole $comRole;

    public string $actionForm = "Added";

    public function mount(?ComRole $comRole = null): void
    {
        $this->tabs = $this->tabs();
        $this->comRole = $comRole;
        $this->currentTab = Arr::first($this->tabs);

        if ($this->comRole->exists) {
            $this->actionForm = "Updated";
        }
    }

    public function setCurrentTab(string $name): void
    {
        $this->currentTab = Arr::first(array_filter($this->tabs, fn ($tab) => $tab['name'] === $name));
    }

    #[On('saved')]
    public function saved(string $name, array $role)
    {
        $this->setCurrentTab($name);
        $this->comRole = ComRole::findById($role['id']);
    }

    public function render()
    {
        return view('rbac::livewire.role-management.form');
    }

    protected function tabs(): array
    {
        return [
            [
                'name' => 'role',
                'title' => 'Role Form',
                'icon' => 'fa-regular fa-shield-keyhole fa-fw',
                'view' => 'rbac::role-management.form-role',
            ],
            [
                'name' => 'nav',
                'title' => 'Navigation Access',
                'icon' => 'fa-regular fa-square-list fa-fw',
                'view' => 'rbac::role-management.form-nav'
            ],
            [
                'name' => 'permission',
                'title' => 'Permission Role',
                'icon' => 'fa-regular fa-key fa-fw',
                'view' => 'rbac::role-management.form-permission'
            ],
        ];
    }
}
