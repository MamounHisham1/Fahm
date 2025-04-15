<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'profile_id' => Profile::inRandomOrder()->first()->id,
            'client_id' => Client::inRandomOrder()->first()->id,
            'name' => fake()->name(),
            'status' => fake()->randomElement(['pending', 'in_progress', 'completed']),
            'gender' => fake()->randomElement(['male', 'female']),
        ];
    }
}
