<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolesAndAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles if they don't exist
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
            ['description' => 'System Administrator']
        );

        $farmerRole = Role::firstOrCreate(
            ['name' => 'farmer'],
            ['description' => 'Farmer User']
        );

        // Create admin user
        $adminUser = User::firstOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'System Administrator',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
            ]
        );

        // Assign admin role to admin user if not already assigned
        if (!$adminUser->hasRole('admin')) {
            $adminUser->roles()->attach($adminRole);
        }

        $this->command->info('Admin user created with username: admin and password: admin123');
    }
}
