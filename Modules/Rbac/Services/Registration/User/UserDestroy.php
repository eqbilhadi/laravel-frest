<?php

namespace Modules\Rbac\Services\Registration\User;

use Modules\Authentication\App\Models\ComUser;
use Modules\Rbac\Services\Registration\RegistrationService;

class UserDestroy extends RegistrationService
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
            ComUser::destroy($this->id);
        } else {
            ComUser::find($this->id)?->delete();
        }
    }
}
