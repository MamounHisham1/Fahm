<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignment>
 */
class AssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::where('role', UserRole::Teacher)->inRandomOrder()->first();
        $client = $user->client;
        $subject = $client->subjects()->inRandomOrder()->first();

        return [
            'client_id' => $client->id,
            'subject_id' => $subject->id,
            'title' => fake()->realText(10),
            'description' => fake()->realText(100),
            'type' => fake()->randomElement(['file', 'text']),
            'due_date' => fake()->dateTimeBetween('now', '+30 days'),
            'max_score' => 100,
        ];
    }
}
