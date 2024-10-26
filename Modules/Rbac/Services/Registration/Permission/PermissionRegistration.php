<?php

namespace Modules\Rbac\Services\Registration\Permission;

use Illuminate\Support\Arr;
use Modules\Rbac\App\Models\ComPermission;
use Modules\Rbac\App\Models\ComRole;
use Modules\Rbac\Services\Registration\RegistrationService;

class PermissionRegistration extends RegistrationService
{

    protected array $data = [];

    protected ?ComPermission $comPermission = null;

    /**
     * Method __construct
     *
     * @param ?ComPermission $comPermission [explicite description]
     * @param array $data [explicite description]
     *
     * @return void
     */
    public function __construct(array $data = [], ?ComPermission $comPermission = null)
    {
        $this->data = $data;

        $this->comPermission = $comPermission;
    }

    /**
     * Method save
     *
     * @return void
     */
    public function save(): void
    {
        if (!$this->comPermission->exists) {
            $this->create();
        } else {
            $this->update();
        }
    }

    /**
     * Method create
     *
     * @return static
     */
    protected function create(): static
    {
        $this->comPermission = ComPermission::create($this->getRegistrationDataComPermission());
        if (is_array($this->data['role'])) {
            foreach ($this->data['role'] as $roleId) {
                $role = ComRole::find($roleId);
                $role->givePermissionTo($this->comPermission);
            }
        }

        return $this;
    }

    /**
     * Method update
     *
     * @return static
     */
    protected function update(): static
    {
        $this->comPermission->update($this->getRegistrationDataComPermission());
        if (is_array($this->data['role'])) {
            // Berikan permission ke role yang ada dalam array
            $givePermission = ComRole::whereIn('id', $this->data['role'])->get();
            $givePermission->each(fn ($role) => $role->givePermissionTo($this->comPermission));

            // Hapus permission dari role yang tidak ada di array
            $revokePermission = ComRole::whereNotIn('id', $this->data['role'])->get();
            $revokePermission->each(fn ($role) => $role->revokePermissionTo($this->comPermission));
        }

        return $this;
    }

    /**
     * Method getRegistrationDataComPermission
     *
     * @return array
     */
    protected function getRegistrationDataComPermission(): array
    {
        // set data
        $data = [
            'name' => Arr::get($this->data, 'name'),
        ];

        $data = array_map(function ($value) {
            return $value === "" ? null : $value;
        }, $data);

        return $data;
    }
}
