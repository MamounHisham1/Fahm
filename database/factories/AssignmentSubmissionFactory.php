<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\Assignment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AssignmentSubmission>
 */
class AssignmentSubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $assignment = Assignment::where('status', '!=', 'pending')->inRandomOrder()->first();
        $student = User::where('role', UserRole::Student)
            ->where('client_id', $assignment->client_id)
            ->inRandomOrder()
            ->first();

        return [
            'assignment_id' => $assignment->id,
            'user_id' => $student->id,
            'type' => fake()->randomElement(['text', 'file']),
            'file' => null,
            'text' => fake()->realText(100),
        ];
    }
}
