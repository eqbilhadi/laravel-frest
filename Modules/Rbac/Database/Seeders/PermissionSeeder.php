<?php

namespace Modules\Rbac\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Rbac\App\Models\ComPermission;
use Modules\Rbac\App\Models\ComRole;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** Navigation Permission */
        $sortNav = ComPermission::firstOrCreate(['name' => 'navigation-sort']);
        $deleteNav = ComPermission::firstOrCreate(['name' => 'navigation-delete']);
        $editNav = ComPermission::firstOrCreate(['name' => 'navigation-edit']);
        $createNav = ComPermission::firstOrCreate(['name' => 'navigation-create']);

        /** Permission of Permissions */
        $deletePermission = ComPermission::firstOrCreate(['name' => 'permission-delete']);
        $editPermission = ComPermission::firstOrCreate(['name' => 'permission-edit']);
        $createPermission = ComPermission::firstOrCreate(['name' => 'permission-create']);

        /** Role Permission */
        $deleteRole = ComPermission::firstOrCreate(['name' => 'role-delete']);
        $editRole = ComPermission::firstOrCreate(['name' => 'role-edit']);
        $createRole = ComPermission::firstOrCreate(['name' => 'role-create']);
        
        /** User Permission */
        $deleteUser = ComPermission::firstOrCreate(['name' => 'user-delete']);
        $editUser = ComPermission::firstOrCreate(['name' => 'user-edit']);
        $createUser = ComPermission::firstOrCreate(['name' => 'user-create']);

        /** Assign Permission to Developer */
        $developer = ComRole::findByName('developer');
        $developer->syncPermissions([
            $sortNav,
            $deleteNav,
            $editNav,
            $createNav,
            $deletePermission,
            $editPermission,
            $createPermission,
            $deleteRole,
            $editRole,
            $createRole,
            $deleteUser,
            $editUser,
            $createUser,
        ]);
    }
}
