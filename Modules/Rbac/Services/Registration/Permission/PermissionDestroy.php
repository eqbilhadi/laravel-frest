<?php

namespace Modules\Rbac\Services\Registration\Permission;

use Modules\Rbac\App\Models\ComPermission;
use Modules\Rbac\Services\Registration\RegistrationService;

class PermissionDestroy extends RegistrationService
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
            ComPermission::destroy($this->id);
        } else {
            ComPermission::find($this->id)->delete();
        }
    }
}
