<?php

namespace Modules\Authentication\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Authentication\App\Models\ComUser;
use Modules\Rbac\App\Models\ComRole;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $username = $this->command->ask('Enter username user:');
        while (ComUser::where('username', $username)->exists()) {
            $this->command->error('Username already registered. Please try another username!');
            $username = $this->command->ask('Masukkan username:');
        }

        $password = $this->command->secret('Enter password user:');

        $roles = ComRole::get()->pluck('name')->toArray();
        $role = $this->command->choice('Choice role:', $roles, 0);

        $user = ComUser::create([
            'username' => $username,
            'email' => fake()->email(),
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'password' => Hash::make($password),
            'gender' => fake()->randomElement(['l', 'p'])
        ]);

        $user->assignRole($role);
        $this->command->info('User successfully created!');
    }
}
