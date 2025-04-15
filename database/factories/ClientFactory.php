<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'name' => fake()->name(),
            'website' => fake()->url(),
            'facebook' => fake()->url(),
            'instagram' => fake()->url(),
            'youtube' => fake()->url(),
            'whatsapp' => fake()->url(),
            'telegram' => fake()->url(),
        ];
    }
}
