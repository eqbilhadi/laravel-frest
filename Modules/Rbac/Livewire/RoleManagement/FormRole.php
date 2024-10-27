<?php

namespace Modules\Rbac\Livewire\RoleManagement;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Modules\Rbac\App\Models\ComRole;
use Modules\Rbac\Livewire\Validations\RoleValidation;
use Modules\Rbac\Services\Registration\Role\RoleRegistration;

class FormRole extends Component
{
    use RoleValidation;

    public string $actionForm = "Added";

    public array $form = [
        'name' => '',
        'icon' => '',
        'color' => '#5a8dee',
    ];

    public ComRole $comRole;

    public function mount()
    {
        if ($this->comRole->exists) {
            $this->fillForm();
        }
    }

    public function fillForm()
    {
        $this->form = [
            'name' => $this->comRole->name,
            'icon' => $this->comRole->icon,
            'color' => $this->comRole->color,
        ];
    }

    public function save()
    {
        $this->validate();

        try {
            $role = (new RoleRegistration($this->form, $this->comRole))->handle();
            
            toastr()->closeButton(true)->addSuccess($this->actionForm . ' role successfully');
            $this->dispatch('saved', name: "nav", role: $role->comRole);
        } catch (\Exception $err) {
            toastr()->closeButton(true)->addError('Something went wrong, try again later!');
            Log::info($err->getMessage());
        }
    }

    public function render()
    {
        return view('rbac::livewire.role-management.form-role');
    }
}
