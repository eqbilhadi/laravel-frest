<?php

namespace Modules\Rbac\Services\Registration\User;

use Illuminate\Support\Arr;
use Modules\Authentication\App\Models\ComUser;
use Modules\Rbac\App\Models\ComRole;
use Modules\Rbac\Services\Registration\RegistrationService;

class UserRegistration extends RegistrationService
{
    protected array $data;
    public ?ComUser $comUser;

    public function __construct(array $data = [], ?ComUser $comUser = null)
    {
        $this->data = $data;
        $this->comUser = $comUser;
    }

    public function save(): static
    {
        return $this->comUser->exists ? $this->update() : $this->create();
    }

    protected function create(): static
    {
        $this->comUser = ComUser::create($this->getRegistrationDataComUser());

        if ($roles = Arr::get($this->data, 'roles')) {
            $roles = array_map(fn($value) => ComRole::find($value), $roles);
            $this->comUser->syncRoles($roles);
        }

        return $this;
    }

    protected function update(): static
    {
        $this->comUser->update($this->getRegistrationDataComUser());

        if ($roles = Arr::get($this->data, 'roles')) {
            $roles = array_map(fn($value) => ComRole::find($value), $roles);
            $this->comUser->syncRoles($roles);
        }

        return $this;
    }

    protected function getRegistrationDataComUser(): array
    {
        $data = [
            'username' => Arr::get($this->data, 'username'),
            'email' => Arr::get($this->data, 'email'),
            'firstname' => Arr::get($this->data, 'firstname'),
            'lastname' => Arr::get($this->data, 'lastname'),
            'birthplace' => Arr::get($this->data, 'birthplace'),
            'birthdate' => Arr::get($this->data, 'birthdate'),
            'gender' => Arr::get($this->data, 'gender'),
            'avatar' => Arr::get($this->data, 'avatar'),
            'phone' => Arr::get($this->data, 'phone'),
            'address' => Arr::get($this->data, 'address'),
        ];

        // Add password only if provided
        if ($password = Arr::get($this->data, 'password')) {
            $data['password'] = $password;
        }

        if (($avatar = Arr::get($this->data, 'avatar')) && $avatar instanceof \Illuminate\Http\UploadedFile) {
            // delete avatar user if exist in database and file
            if ($this->comUser?->avatar != null && str_contains($this->comUser?->avatar, 'user-avatars') && file_exists($this->comUser?->avatar)) {
                unlink($this->comUser?->avatar);
            }

            $data['avatar'] = $avatar->store('assets/images/user-avatars', 'public_upload');
        } elseif (Arr::get($this->data, 'avatar') === null && $this->comUser?->avatar != null && str_contains($this->comUser?->avatar, 'user-avatars') && file_exists($this->comUser?->avatar)) {
            // delete avatar user if avatar is set to null
            unlink($this->comUser?->avatar);
            $data['avatar'] = null;
        }

        return array_map(fn($value) => $value === "" ? null : $value, $data);
    }
}
