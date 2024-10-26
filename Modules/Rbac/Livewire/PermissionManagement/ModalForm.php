<?php

namespace Modules\Rbac\Livewire\PermissionManagement;

use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use Modules\Rbac\App\Models\ComPermission;
use Modules\Rbac\App\Models\ComRole;
use Modules\Rbac\Livewire\Validations\PermissionValidation;
use Modules\Rbac\Services\Registration\Permission\PermissionRegistration;

class ModalForm extends Component
{
    use PermissionValidation;

    public string $actionForm = "add";

    public array $form = [
        "name" => "jancok",
        "role" => ""
    ];

    public array $options = [];

    public ?ComPermission $comPermission = null;

    /**
     * Method openModal
     *
     * @return void
     */
    #[On('open-permission-form')]
    public function openModal(?ComPermission $comPermission = null)
    {
        $this->resetForm();

        $this->comPermission = $comPermission;
        if ($this->comPermission->exists) {
            $this->actionForm = "Edit";
            $this->fillForm();
        } else {
            $this->actionForm = "Add";
        }

        $this->dispatch('open-modal');
    }

    public function mount()
    {
        $this->options['roles'] = ComRole::latest()->get()->toArray();
    }
    
    public function fillForm()
    {
        $this->form = [
            "name" => $this->comPermission->name,
            "role" => $this->comPermission->roles()->pluck('id')->toArray()
        ];

        $this->dispatch('load-select2', role: $this->form['role']);
    }

    public function save()
    {
        $this->validate();

        try {
            (new PermissionRegistration($this->form, $this->comPermission))->handle();

            toastr()->closeButton(true)->addSuccess($this->actionForm . ' permission successfully');
            $this->dispatch('saved');
        } catch (\Exception $err) {
            toastr()->closeButton(true)->addError('Something went wrong, try again later!');
            Log::info($err->getMessage());
        }
    }

    public function render()
    {
        return view('rbac::livewire.permission-management.modal-form');
    }

    protected function resetForm()
    {
        $this->resetValidation();
        $this->form = [
            "name" => "",
            "role" => ""
        ];
        $this->dispatch('reset-select2', role: $this->form['role']);
    }
}
