<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $adminId = DB::table('users')->insertGetId([
            'name' => 'System Admin',
            'username' => 'admin',
            'email' => 'admin@livestockims.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create farmer user
        $farmerId = DB::table('users')->insertGetId([
            'name' => 'John Farmer',
            'username' => 'farmer',
            'email' => 'farmer@livestockims.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Get role IDs
        $adminRoleId = DB::table('roles')->where('name', 'admin')->first()->id;
        $farmerRoleId = DB::table('roles')->where('name', 'farmer')->first()->id;

        // Assign roles to users
        DB::table('role_user')->insert([
            [
                'user_id' => $adminId,
                'role_id' => $adminRoleId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $farmerId,
                'role_id' => $farmerRoleId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Create a sample farm for the farmer
        DB::table('farms')->insert([
            'user_id' => $farmerId,
            'name' => 'Green Meadows Farm',
            'address' => '123 Farm Road, Countryside',
            'location' => 'Countryside',
            'size' => '25 acres',
            'description' => 'A family-owned farm specializing in dairy and poultry.',
            'phone' => '555-123-4567',
            'email' => 'contact@greenmeadowsfarm.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
