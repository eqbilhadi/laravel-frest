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
        $sortNav = ComPermission::firstOrCreate(['name' => 'sort-navigation']);
        $deleteNav = ComPermission::firstOrCreate(['name' => 'delete-navigation']);
        $editNav = ComPermission::firstOrCreate(['name' => 'edit-navigation']);
        $createNav = ComPermission::firstOrCreate(['name' => 'create-navigation']);

        /** Permission of Permissions */
        $deletePermission = ComPermission::firstOrCreate(['name' => 'delete-permission']);
        $editPermission = ComPermission::firstOrCreate(['name' => 'edit-permission']);
        $createPermission = ComPermission::firstOrCreate(['name' => 'create-permission']);

        /** Role Permission */
        $deleteRole = ComPermission::firstOrCreate(['name' => 'delete-role']);
        $editRole = ComPermission::firstOrCreate(['name' => 'edit-role']);
        $createRole = ComPermission::firstOrCreate(['name' => 'create-role']);

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
        ]);
    }
}
