<?php

namespace Modules\Rbac\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'developer', 'color' => '#465aeb', 'icon' => 'fa-solid fa-laptop-code']);
        Role::firstOrCreate(['name' => 'superadmin', 'color' => '#e01814', 'icon' => 'fa-solid fa-user-crown']);
        Role::firstOrCreate(['name' => 'admin', 'color' => '#f79d16', 'icon' => 'fa-solid fa-user-tie']);
        Role::firstOrCreate(['name' => 'user', 'color' => '#635744', 'icon' => 'fa-solid fa-user']);
    }
}
