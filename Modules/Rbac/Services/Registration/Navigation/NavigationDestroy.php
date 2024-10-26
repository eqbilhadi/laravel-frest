<?php

namespace Modules\Rbac\Services\Registration\Navigation;

use Modules\Rbac\App\Models\ComMenu;
use Modules\Rbac\Services\Registration\RegistrationService;

class NavigationDestroy extends RegistrationService
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
            ComMenu::destroy($this->id);
        } else {
            ComMenu::find($this->id)->delete();
        }
    }
}
