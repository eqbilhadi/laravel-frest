<?php

namespace Modules\Rbac\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Rbac\App\Models\ComMenu;
use Modules\Rbac\App\Models\ComRole;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $developer = ComRole::findByName('developer');

        $homeMenu = ComMenu::firstOrCreate([
            'icon' => 'fa-solid fa-house-blank',
            'label_name' => 'Home',
            'controller_name' => 'app\Http\Controllers\HomeController',
            'route_name' => 'home',
            'url' => '/',
            'sort_num' => '1',
            'is_divider' => false
        ]);

        $accessSettingMenu = ComMenu::firstOrCreate([
            'icon' => 'fa-solid fa-square-sliders',
            'label_name' => 'Access Settings',
            'controller_name' => null,
            'route_name' => 'rbac.index',
            'url' => 'rbac',
            'sort_num' => '2',
            'is_divider' => false
        ]);

        $menuManagement = ComMenu::firstOrCreate([
            'parent_id' => $accessSettingMenu->id,
            'icon' => 'fa-sharp fa-solid fa-square-list',
            'label_name' => 'Navigation Management',
            'controller_name' => 'Modules\Rbac\app\Http\Controllers\NavigationManagementController',
            'route_name' => 'rbac.nav.index',
            'url' => 'rbac/navigation-management',
            'sort_num' => '1',
        ]);

        $roleManagement = ComMenu::firstOrCreate([
            'parent_id' => $accessSettingMenu->id,
            'icon' => 'fa-sharp fa-solid fa-shield-keyhole',
            'label_name' => 'Role Management',
            'controller_name' => 'Modules\Rbac\app\Http\Controllers\RoleManagementController',
            'route_name' => 'rbac.role.index',
            'url' => 'rbac/role-management',
            'sort_num' => '2',
        ]);

        $userManagement = ComMenu::firstOrCreate([
            'parent_id' => $accessSettingMenu->id,
            'icon' => 'fa-solid fa-users-gear',
            'label_name' => 'User Management',
            'controller_name' => 'Modules\Rbac\app\Http\Controllers\UserManagementController',
            'route_name' => 'rbac.user.index',
            'url' => 'rbac/user-management',
            'sort_num' => '3',
        ]);

        $developer->menus()->sync([
            $homeMenu->id,
            $accessSettingMenu->id,
            $menuManagement->id,
            $roleManagement->id,
            $userManagement->id,
        ]);
    }
}
