<?php

namespace Database\Factories;

use App\Enums\LessonStatus;
use App\Enums\LessonType;
use App\Enums\UserRole;
use App\Models\Client;
use App\Models\Profile;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
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
            'subject_id' => $subject->id,
            'client_id' => $client->id,
            'user_id' => $user->id,
            'title' => fake()->words(3, true),
            'description' => fake()->text(),
            'type' => fake()->randomElement(LessonType::cases()),
        ];
    }
}
