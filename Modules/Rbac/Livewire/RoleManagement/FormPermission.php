<?php

namespace Modules\Rbac\Livewire\RoleManagement;

use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Modules\Rbac\App\Jobs\ForgetCacheMenu;
use Modules\Rbac\App\Models\ComPermission;
use Modules\Rbac\App\Models\ComRole;

class FormPermission extends Component
{
    public string $actionForm = "Added";

    public ComRole $comRole;

    public array $permissionAccess = [];

    #[Computed]
    public function permissions()
    {
        return ComPermission::query()
            ->orderBy('name', 'asc')
            ->get();
    }

    public function mount()
    {
        if ($this->comRole->exists) {
            $this->fillForm();
        }
    }

    public function fillForm()
    {
        $this->permissionAccess = $this->comRole
            ->permissions()
            ->pluck('id')
            ->toArray();
    }

    public function save()
    {
        try {
            $permissionNames = ComPermission::whereIn('id', $this->permissionAccess)->pluck('name')->toArray();
            $this->comRole->syncPermissions($permissionNames);
            dispatch(new ForgetCacheMenu());

            toastr()->closeButton(true)->addSuccess($this->actionForm . ' permission access to role successfully');
            return $this->redirect(route('rbac.role.index'), navigate: true);
        } catch (\Exception $err) {
            toastr()->closeButton(true)->addError('Something went wrong, try again later!');
            Log::info($err->getMessage());
        }
    }

    public function render()
    {
        return view('rbac::livewire.role-management.form-permission');
    }
}
