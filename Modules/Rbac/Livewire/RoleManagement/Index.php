<?php

namespace Modules\Rbac\Livewire\RoleManagement;

use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Modules\Rbac\App\Models\ComRole;
use Modules\Rbac\Services\Registration\Role\RoleDestroy;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    #[Computed()]
    public function roleLists()
    {
        return ComRole::latest()->paginate(10);
    }

    public function delete($id)
    {
        try {
            (new RoleDestroy($id))->handle();

            $this->dispatch('close-modal-delete');
            toastr()->closeButton(true)->addSuccess('Deleted role successfully');
        } catch (\Throwable $err) {
            toastr()->closeButton(true)->addError('Something went wrong, try again later!');
            Log::info($err->getMessage());
        }
    }

    public function render()
    {
        return view('rbac::livewire.role-management.index', [
            "roles" => $this->roleLists
        ]);
    }
}
