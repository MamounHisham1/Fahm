<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\AssignmentGrade;
use App\Models\AssignmentSubmission;
use App\Models\User;
use Illuminate\Database\Seeder;

class AssignmentGradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $submissions = AssignmentSubmission::where('status', 'graded')->get();
        
        foreach ($submissions as $submission) {
            // Create 1-3 grades per submission (multiple teachers might grade)
            $gradeCount = rand(1, 3);
            
            AssignmentGrade::factory()
                ->count($gradeCount)
                ->create([
                    'submission_id' => $submission->id,
                    'user_id' => User::where('role', UserRole::Teacher)->inRandomOrder()->first()->id,
                ]);
        }
    }
}
