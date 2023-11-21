<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visit>
 */
class VisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'external_id' => $this->faker->unique()->bothify('??????????????????'),
            'stage' => $this->faker->randomElement(['visited', 'viewed_page', 'searched', 'contacted', 'completed', 'cancelled', 'declined', null]),
            // Add other columns as needed
        ];
    }
}
