<?php

namespace Modules\Rbac\Services\Registration\Role;

use Illuminate\Support\Arr;
use Modules\Rbac\App\Models\ComRole;
use Modules\Rbac\Services\Registration\RegistrationService;

class RoleRegistration extends RegistrationService
{

    protected array $data = [];

    public ?ComRole $comRole = null;

    /**
     * Method __construct
     *
     * @param ?ComRole $comRole [explicite description]
     * @param array $data [explicite description]
     *
     * @return void
     */
    public function __construct(array $data = [], ?ComRole $comRole = null)
    {
        $this->data = $data;

        $this->comRole = $comRole;
    }

    /**
     * Method save
     *
     * @return void
     */
    public function save(): static
    {
        if (!$this->comRole->exists) {
            return $this->create();
        } else {
            return $this->update();
        }
    }

    /**
     * Method create
     *
     * @return static
     */
    protected function create(): static
    {
        $this->comRole = ComRole::create($this->getRegistrationDataComRole());

        return $this;
    }

    /**
     * Method update
     *
     * @return static
     */
    protected function update(): static
    {
        $this->comRole->update($this->getRegistrationDataComRole());

        return $this;
    }

    /**
     * Method getRegistrationDataComRole
     *
     * @return array
     */
    protected function getRegistrationDataComRole(): array
    {
        // set data
        $data = [
            'name' => Arr::get($this->data, 'name'),
            'icon' => Arr::get($this->data, 'icon'),
            'color' => Arr::get($this->data, 'color'),
        ];

        $data = array_map(function ($value) {
            return $value === "" ? null : $value;
        }, $data);

        return $data;
    }
}
