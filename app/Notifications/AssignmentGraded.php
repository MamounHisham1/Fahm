<?php

namespace App\Notifications;

use App\Models\AssignmentGrade;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class AssignmentGraded extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public AssignmentGrade $grade
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => "Your assignment has been graded: {$this->grade->score}/{$this->grade->submission->assignment->max_score}",
            'grade_id' => $this->grade->id,
            'submission_id' => $this->grade->submission_id,
            'assignment_title' => $this->grade->submission->assignment->title,
            'score' => $this->grade->score,
            'max_score' => $this->grade->submission->assignment->max_score,
            'feedback' => $this->grade->feedback,
            'url' => route('client.assignments.show', $this->grade->submission->assignment),
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => "Your assignment has been graded: {$this->grade->score}/{$this->grade->submission->assignment->max_score}",
            'grade_id' => $this->grade->id,
            'submission_id' => $this->grade->submission_id,
            'assignment_title' => $this->grade->submission->assignment->title,
            'score' => $this->grade->score,
            'max_score' => $this->grade->submission->assignment->max_score,
        ];
    }
}
