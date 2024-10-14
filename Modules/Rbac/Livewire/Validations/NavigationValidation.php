<?php

namespace Modules\Rbac\Livewire\Validations;

trait NavigationValidation
{

    protected array $validationAttributes = [
        'form.parent_id' => 'parent navigation',
        'form.icon' => 'icon',
        'form.label_name' => 'label name',
        'form.controller_name' => 'controller name',
        'form.route_name' => 'route name',
        'form.url' => 'url',
        'form.is_active' => 'status',
        'form.is_divider' => 'divider',
    ];

    protected function rules(): array
    {
        return [
            'form.parent_id' => 'nullable|numeric',
            'form.icon' => 'required|max:255',
            'form.label_name' => 'required|max:255',
            'form.controller_name' => ($this->form['parent_id'] != '') ? 'required' : 'nullable|max:255',
            'form.route_name' => 'required|max:255',
            'form.url' => 'required|max:255',
            'form.is_active' => 'required|in:1,0',
            'form.is_divider' => 'required|in:1,0',
        ];
    }
}
