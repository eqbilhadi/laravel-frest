<?php

namespace Modules\Rbac\Livewire\RoleManagement;

use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Modules\Rbac\App\Jobs\ForgetCacheMenu;
use Modules\Rbac\App\Models\ComMenu;
use Modules\Rbac\App\Models\ComRole;

class FormNav extends Component
{
    public string $actionForm = "Added";

    public ComRole $comRole;

    public array $navAccess = [];

    #[Computed]
    public function menus()
    {
        return ComMenu::query()
            ->whereNull('parent_id')
            ->with('children')
            ->orderBy('sort_num')
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
        $this->navAccess = $this->comRole
            ->menus()
            ->pluck('id')
            ->toArray();
    }

    public function save()
    {
        try {
            $this->comRole->menus()->sync($this->navAccess);
            dispatch(new ForgetCacheMenu());
            
            toastr()->closeButton(true)->addSuccess($this->actionForm . ' navigation access to role successfully');
            $this->dispatch('saved', name: "permission", role: $this->comRole);
        } catch (\Exception $err) {
            toastr()->closeButton(true)->addError('Something went wrong, try again later!');
            Log::info($err->getMessage());
        }
    }

    public function render()
    {
        return view('rbac::livewire.role-management.form-nav');
    }
}
