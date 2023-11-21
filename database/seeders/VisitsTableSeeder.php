<?php

namespace Database\Seeders;

use App\Models\Visit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class VisitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Create 1000 visits
        foreach (range(1, 1000) as $index) {
            Visit::create([
                'external_id' => $faker->unique()->bothify('??????????????????'), // Generates a 16-character alpha-numeric string
                'stage' => $faker->randomElement(['visited', 'viewed_page', 'searched', 'contacted', 'completed', 'cancelled', 'declined', null]),
            ]);
        }
    }
}
