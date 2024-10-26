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
        Role::firstOrCreate(['name' => 'developer', 'color' => '#465aeb']);
        Role::firstOrCreate(['name' => 'superadmin', 'color' => '#e01814']);
        Role::firstOrCreate(['name' => 'admin', 'color' => '#f79d16']);
        Role::firstOrCreate(['name' => 'user', 'color' => '#635744']);
    }
}
