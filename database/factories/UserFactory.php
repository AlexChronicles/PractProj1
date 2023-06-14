<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
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
            'email' => fake()->unique()->safeEmail(),
            'password' => fake()->password(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */

}
