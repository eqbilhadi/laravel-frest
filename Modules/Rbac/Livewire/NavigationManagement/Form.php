<?php

namespace Modules\Rbac\Livewire\NavigationManagement;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Modules\Rbac\App\Jobs\ForgetCacheMenu;
use Modules\Rbac\App\Models\ComMenu;
use Modules\Rbac\Livewire\Validations\NavigationValidation;
use Modules\Rbac\Services\Registration\Navigation\NavigationRegistration;

class Form extends Component
{
    use NavigationValidation;

    public ?ComMenu $comMenu = null;

    public array $form = [
        'parent_id' => '',
        'sort_num' => '',
        'icon' => '',
        'label_name' => '',
        'controller_name' => '',
        'route_name' => '',
        'url' => '',
        'is_active' => '1',
        'is_divider' => '0',
    ];

    public string $action = "Added";
    public array $options = [];

    public function mount(?ComMenu $comMenu = null)
    {
        $this->comMenu = $comMenu;
        if ($this->comMenu->exists) {
            $this->fillForm();
            $this->action = "Updated";
        }

        $this->options['parents_nav'] = ComMenu::whereNull('parent_id')
            ->select('id', 'label_name')
            ->orderBy('sort_num')
            ->get()
            ->toArray();
    }

    public function fillForm()
    {
        $this->form = [
            'parent_id' => $this->comMenu->parent_id ?? '',
            'sort_num' => $this->comMenu->sort_num,
            'icon' => $this->comMenu->icon,
            'label_name' => $this->comMenu->label_name,
            'controller_name' => $this->comMenu->controller_name,
            'route_name' => $this->comMenu->route_name,
            'url' => $this->comMenu->url,
            'is_active' => $this->comMenu->is_active,
            'is_divider' => $this->comMenu->is_divider,
        ];
    }

    public function resetForm()
    {
        $this->reset('form');
        $this->resetValidation();

        if ($this->comMenu->exists) {
            $this->fillForm();
        }
        $isDivider = !($this->form['parent_id'] == '');
        $this->dispatch('reseted-form', is_divider: $isDivider);
    }

    public function save()
    {
        $this->validate();
        try {
            (new NavigationRegistration($this->form, $this->comMenu))->handle();
            dispatch(new ForgetCacheMenu());

            toastr()->closeButton(true)->addSuccess($this->action . ' navigation successfully');
            return $this->redirect(route('rbac.nav.index'), navigate: true);
        } catch (\Exception $err) {
            toastr()->closeButton(true)->addError('Something went wrong, try again later!');
            Log::info($err->getMessage());
        }
    }

    public function render()
    {
        return view('rbac::livewire.navigation-management.form');
    }
}
