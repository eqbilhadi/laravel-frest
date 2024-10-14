<?php

namespace Modules\Rbac\App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Role as SpatieRole;

class ComRole extends SpatieRole
{
    /**
     * Method menus
     *
     * @return BelongsToMany
     */
    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(ComMenu::class, 'com_menus_has_roles', 'role_id', 'menu_id');
    }
}
