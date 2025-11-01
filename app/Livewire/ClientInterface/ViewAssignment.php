<?php

namespace App\Livewire\ClientInterface;

use App\Enums\UserRole;
use App\Models\Assignment;
use App\Models\User;
use App\Notifications\NewAssignmentSubmission;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Context;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.app.client-interface')]
class ViewAssignment extends Component
{
    use WithFileUploads;

    public $client;
    public $assignment;
    public $submission;
    public $file;
    public $text;
    public $type = 'file';
    public $alerts = [];

    public function mount(Assignment $assignment)
    {
        $this->client = Context::getHidden('client');

        abort_if($assignment->client_id !== $this->client->id, 404);

        $this->assignment = $assignment;
        $this->submission = $this->assignment->submissions()->where('user_id', Auth::id())->first();
    }

    public function render()
    {
        return view('livewire.client-interface.view-assignment');
    }

    public function submitAssignment()
    {
        $this->validate([
            'type' => ['required', 'in:file,text'],
            'file' => ['required_if:type,file', 'nullable', 'file', 'mimes:pdf,doc,docx,txt,png,jpg,jpeg', 'max:10240'],
            'text' => ['required_if:type,text', 'nullable', 'string'],
        ]);

        $this->createSubmission();

        $this->updateStatus();

        $this->notifyTeachers();

        $this->resetForm();

        $this->alerts[] = [
            'type' => 'success',
            'message' => 'Assignment submitted successfully!',
        ];
    }

    private function createSubmission()
    {
        $submission = [
            'user_id' => request()->user()->id,
            'type' => $this->type,
        ];

        $this->type === 'file' ? $submission['file'] = $this->file->store('assignments', 'public') : $submission['text'] = $this->text;

        $this->submission = $this->assignment->submissions()->create($submission);
    }

    private function updateStatus()
    {
        if ($this->assignment->status === 'pending') {
            $this->assignment->update(['status' => 'submitted']);
        }
    }

    private function notifyTeachers()
    {
        $teachers = User::where('client_id', $this->client->id)
            ->where('role', '!==', UserRole::Student)
            ->get();

        foreach ($teachers as $teacher) {
            Notification::make()
                ->title('New assignment submitted')
                ->body('A new assignment has been submitted by ' . Auth::user()->name . ' for ' . $this->assignment->title)
                ->sendToDatabase($teacher);
        }
    }

    private function resetForm()
    {
        $this->file = null;
        $this->text = null;
    }
}
