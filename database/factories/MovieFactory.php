<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        date_default_timezone_set('Europe/Moscow');
        return [
            'name' => fake()->unique()->name(),
            'BudgetInMillions' => fake()->randomNumber(),
        ];
    }
}
