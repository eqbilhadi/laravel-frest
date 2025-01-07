<?php

namespace Modules\Rbac\Livewire\UserManagement;

use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Modules\Authentication\App\Models\ComUser;
use Modules\Rbac\Services\Registration\User\UserDestroy;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $paginationTheme = "bootstrap";

    #[Computed]
    public function users()
    {
        return ComUser::latest()->paginate(15);
    }

    public function delete($id)
    {
        try {
            (new UserDestroy($id))->handle();

            $this->dispatch('close-modal-delete');
            toastr()->closeButton(true)->addSuccess('Deleted user successfully');
        } catch (\Throwable $err) {
            toastr()->closeButton(true)->addError('Something went wrong, try again later!');
            Log::error($err->getMessage());
        }
    }

    public function render()
    {
        return view('rbac::livewire.user-management.index', [
            'users' => $this->users
        ]);
    }
}
