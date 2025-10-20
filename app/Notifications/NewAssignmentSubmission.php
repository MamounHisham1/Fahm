<?php

namespace App\Notifications;

use App\Models\AssignmentSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewAssignmentSubmission extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public AssignmentSubmission $submission
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => "New submission for assignment: {$this->submission->assignment->title}",
            'submission_id' => $this->submission->id,
            'assignment_id' => $this->submission->assignment_id,
            'student_name' => $this->submission->user->name,
            'assignment_title' => $this->submission->assignment->title,
            'submission_type' => $this->submission->type,
            'url' => route('filament.resources.assignment-submissions.grade', $this->submission),
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => "New submission for assignment: {$this->submission->assignment->title}",
            'submission_id' => $this->submission->id,
            'assignment_id' => $this->submission->assignment_id,
            'student_name' => $this->submission->user->name,
            'assignment_title' => $this->submission->assignment->title,
        ];
    }
}
