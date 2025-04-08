<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the custom seeders in the correct order
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            LivestockCategorySeeder::class,
            SettingsSeeder::class,
        ]);
    }
}
