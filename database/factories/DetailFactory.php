<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Detail>
 */
class DetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start_date' => now(),
            'end_date' => now()->addHour()->addMonth(),
            'description' => $this->faker->paragraph(),
            'tags' => implode(',', $this->faker->words(3)),
        ];
    }
}
