<?php

namespace Modules\Rbac\Services\Registration\Role;

use Modules\Rbac\App\Models\ComRole;
use Modules\Rbac\Services\Registration\RegistrationService;

class RoleDestroy extends RegistrationService
{
    protected $id;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    /**
     * Save action
     *
     * @return void
     */
    public function save(): void
    {
        if(is_array($this->id)) {
            ComRole::destroy($this->id);
        } else {
            ComRole::find($this->id)->delete();
        }
    }
}
