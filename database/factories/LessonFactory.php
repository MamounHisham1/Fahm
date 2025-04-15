<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Subject;
use App\Models\Teacher;
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
        return [
            'subject_id' => Subject::inRandomOrder()->first()->id,
            'client_id' => Client::inRandomOrder()->first()->id,
            'teacher_id' => Teacher::inRandomOrder()->first()->id,
            'name' => fake()->name(),
            'description' => fake()->text(),
            'status' => fake()->randomElement(['pending', 'in_progress', 'completed']),
        ];
    }
}
