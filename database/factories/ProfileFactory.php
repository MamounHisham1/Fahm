<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();
        $client = $user->client;

        return [
            'user_id' => $user->id,
            'client_id' => $client->id,
            'status' => fake()->randomElement(['active', 'inactive']),
            'gender' => fake()->randomElement(['male', 'female']),
            'avatar' => fake()->imageUrl(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'bio' => fake()->realText(),
        ];
    }
}
