<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LivestockCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Cattle',
                'species' => 'Bos taurus',
                'description' => 'Domesticated ungulates commonly raised for meat, milk, and hides.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Goat',
                'species' => 'Capra aegagrus hircus',
                'description' => 'Domesticated species of goat-antelope typically kept for milk, meat, and hair.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sheep',
                'species' => 'Ovis aries',
                'description' => 'Domesticated ruminant mammal typically raised for fleece, meat, and milk.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Poultry',
                'species' => 'Gallus gallus domesticus',
                'description' => 'Domesticated birds kept by humans for eggs, meat, and feathers.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pig',
                'species' => 'Sus scrofa domesticus',
                'description' => 'Domesticated omnivorous mammals raised primarily for meat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('livestock_categories')->insert($categories);
    }
}
