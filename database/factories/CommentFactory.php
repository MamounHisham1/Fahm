<?php

namespace Database\Factories;

use App\Enums\LessonStatus;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('role', 'student')->inRandomOrder()->first()->id,
            'lesson_id' => Lesson::where('status', LessonStatus::Completed)->inRandomOrder()->first()->id,
            'parent_id' => null,
            'body' => fake()->realTextBetween(50, 300),
        ];
    }
}
