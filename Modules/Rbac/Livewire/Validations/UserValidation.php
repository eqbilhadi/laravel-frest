<?php

namespace Modules\Rbac\Livewire\Validations;

use Illuminate\Validation\Rule;
use Modules\Authentication\App\Models\ComUser;

trait UserValidation
{
    protected array $validationAttributes = [
        'form.username' => 'username',
        'form.email' => 'email',
        'form.firstname' => 'firstname',
        'form.lastname' => 'lastname',
        'form.gender' => 'gender',
        'form.avatar' => 'avatar',
        'form.password' => 'password',
        'form.roles' => 'role',
    ];

    protected function rules(): array
    {
        return [
            'form.username' => ['required', 'string', 'max:255', 'lowercase', Rule::unique(ComUser::class, 'username')->ignore($this->comUser->id)],
            'form.email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(ComUser::class, 'email')->ignore($this->comUser->id)],
            'form.firstname' => ['required', 'string', 'max:255'],
            'form.lastname' => ['required', 'string', 'max:255'],
            'form.gender' => ['required', 'in:l,p'],
            'form.avatar' => ['nullable', $this->form['avatar'] instanceof \Illuminate\Http\UploadedFile ? 'image' : ''],
            'form.password' => ['required_if:actionForm,Added'],
            'form.roles' => ['required'],
        ];
    }

    protected function messages(): array
    {
        return [
            'form.password.required_if' => 'The :attribute is required when create a user.',
        ];
    }
}
