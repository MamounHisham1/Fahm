<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Database\Seeder;

class AssignmentSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assignments = Assignment::where('status', '!=', 'pending')->get();
        
        foreach ($assignments as $assignment) {
            $submissionCount = rand(1, 5);
            
            AssignmentSubmission::factory()
                ->count($submissionCount)
                ->create([
                    'assignment_id' => $assignment->id,
                ]);
        }
    }
}
