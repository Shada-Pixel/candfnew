<?php

namespace Database\Factories;

use App\Models\Agent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomFile>
 */
class CustomFileFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'be_number' => 'BE-' . fake()->unique()->numerify('########'),
            'fees' => fake()->randomFloat(2, 100, 100000),
            'type' => fake()->randomElement([
                'Import',
                'Export',
                'Transit',
                'Other',
            ]),
            'status' => fake()->randomElement([
                'Pending',
                'Processing',
                'Completed',
                'Cancelled',
            ]),
            'date' => fake()->dateTimeBetween('-3 years', 'now')->format('Y-m-d'),
            'year' => fake()->numberBetween(2023, 2026),
            'agent_id' => Agent::inRandomOrder()->value('id'),
        ];
    }
}
