<?php

namespace Modules\Rbac\Livewire\Validations;

trait PermissionValidation
{

    protected array $validationAttributes = [
        'form.name' => 'permission name',
    ];

    protected function rules(): array
    {
        return [
            'form.name' => 'required|max:255|string',
        ];
    }
}
