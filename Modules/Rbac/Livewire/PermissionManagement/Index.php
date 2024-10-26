<?php

namespace Modules\Rbac\Livewire\PermissionManagement;

use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Modules\Rbac\App\Models\ComPermission;
use Modules\Rbac\Services\Registration\Permission\PermissionDestroy;

class Index extends Component
{
    #[Computed]
    public function permissionLists()
    {
        return ComPermission::with('roles')->latest()->paginate(10);
    }

    public function delete($id)
    {
        try {
            (new PermissionDestroy($id))->handle();

            $this->dispatch('close-modal-delete');
            toastr()->closeButton(true)->addSuccess('Deleted permission successfully');
        } catch (\Throwable $err) {
            toastr()->closeButton(true)->addError('Something went wrong, try again later!');
            Log::info($err->getMessage());
        }
    }

    #[On('saved')]
    public function saved()
    {
        $this->dispatch('close-modal');
    }

    public function render()
    {
        return view('rbac::livewire.permission-management.index', [
            "permissions" => $this->permissionLists
        ]);
    }
}
