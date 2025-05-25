<?php

namespace App\Livewire\ClientInterface;

use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Context;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

#[Layout('components.layouts.app.client-interface')]
class ViewAssignment extends Component
{
    use WithFileUploads;

    public $assignment;
    public $client;
    public $submission;
    public $file;
    public $text;
    public $type = 'file';

    public function mount(Assignment $assignment)
    {
        $this->client = Context::getHidden('client');
        
        if ($assignment->client_id !== $this->client->id) {
            abort(404);
        }

        $this->assignment = $assignment->load(['subject', 'submissions.grades']);
        $this->submission = $this->assignment->submissions()
            ->where('user_id', Auth::id())
            ->latest()
            ->first();
    }

    public function submitAssignment()
    {
        $this->validate([
            'type' => ['required', 'in:file,text'],
            'file' => ['required_if:type,file', 'nullable', 'file', 'max:10240'],
            'text' => ['required_if:type,text', 'nullable', 'string', 'max:1000'],
        ]);

        $submission = [
            'user_id' => Auth::id(),
            'type' => $this->type,
        ];

        if ($this->type === 'file' && $this->file) {
            $submission['file'] = $this->file->store('assignments');
        } elseif ($this->type === 'text' && $this->text) {
            $submission['text'] = $this->text;
        }

        $this->submission = $this->assignment->submissions()->create($submission);

        if ($this->assignment->status === 'pending') {
            $this->assignment->update(['status' => 'submitted']);
        }

        $this->file = null;
        $this->text = null;

        session()->flash('success', 'Assignment submitted successfully!');
    }

    public function render()
    {
        return view('livewire.client-interface.view-assignment');
    }
}
