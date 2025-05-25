<?php

namespace App\Livewire\ClientInterface;

use App\Models\Assignment as AssignmentModel;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Context;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

#[Layout('components.layouts.app.client-interface')]
class Assignment extends Component
{
    use WithFileUploads;

    public $client;
    public $search = '';
    public $subjectFilter = '';
    public $statusFilter = '';
    public $submission;

    public function mount()
    {
        $this->client = Context::getHidden('client');
    }

    public function render()
    {
        $assignments = AssignmentModel::query()
            ->where('client_id', $this->client->id)
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->subjectFilter, function ($query) {
                $query->where('subject_id', $this->subjectFilter);
            })
            ->when($this->statusFilter, function ($query) {
                if($this->statusFilter == 'submitted') {
                    $query->whereHas('submissions', function ($query) {
                        $query->where('user_id', Auth::id());
                    });
                }
                if($this->statusFilter == 'graded') {
                    $query->whereHas('submissions', function ($query) {
                        $query->where('user_id', Auth::id())->whereHas('grades');
                    });
                }
                if($this->statusFilter == 'pending') {
                    $query->whereDoesntHave('submissions', function ($query) {
                        $query->where('user_id', Auth::id());
                    });
                }
            })
            ->with(['subject', 'submissions.grades'])
            ->latest()
            ->paginate(10);

        $subjects = $this->client->subjects;

        return view('livewire.client-interface.assignment', [
            'assignments' => $assignments,
            'subjects' => $subjects,
        ]);
    }
}
