<?php

namespace Modules\Rbac\Livewire\Validations;

trait RoleValidation
{

    protected array $validationAttributes = [
        'form.name' => 'permission name',
        'form.color' => 'permission color',
        'form.icon' => 'permission icon',
    ];

    protected function rules(): array
    {
        return [
            'form.name' => 'required|max:255|string',
            'form.icon' => 'nullable|max:50|string',
            'form.color' => 'required|max:10',
        ];
    }
}
