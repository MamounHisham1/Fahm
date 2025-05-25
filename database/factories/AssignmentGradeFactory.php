<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\AssignmentSubmission;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AssignmentGrade>
 */
class AssignmentGradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $submission = AssignmentSubmission::where('status', 'graded')->inRandomOrder()->first();
        $teacher = User::where('role', UserRole::Teacher)
            ->where('client_id', $submission->assignment->client_id)
            ->inRandomOrder()
            ->first();

        return [
            'submission_id' => $submission->id,
            'user_id' => $teacher->id,
            'score' => fake()->randomFloat(1, 0, 100),
            'max_score' => 100.0,
            'feedback' => fake()->paragraph(),
        ];
    }
}
