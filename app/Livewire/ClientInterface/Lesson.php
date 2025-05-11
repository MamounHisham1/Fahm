<?php

namespace App\Livewire\ClientInterface;

use App\Enums\LessonStatus;
use App\Models\Client;
use App\Models\Lesson as LessonModel;
use App\Models\Subject;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app.client-interface')]
class Lesson extends Component
{
    use WithPagination;

    public $client;
    public $search = '';
    public $subjectFilter = '';
    public $statusFilter = '';
    public $selectedLesson = null;

    public function mount(Client $client)
    {
        $this->client = $client;
    }

    public function render()
    {
        $subjects = Subject::where('client_id', $this->client->id)->get();
        
        $lessons = LessonModel::query()
            ->where('client_id', $this->client->id)
            ->where('status', LessonStatus::Completed)
            ->when($this->search, function ($query) {
                return $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->subjectFilter, function ($query) {
                return $query->where('subject_id', $this->subjectFilter);
            })
            ->when($this->statusFilter, function ($query) {
                return $query->where('status', $this->statusFilter);
            })
            ->with(['subject', 'teacher'])
            ->latest()
            ->paginate(9);

        return view('livewire.client-interface.lesson', [
            'lessons' => $lessons,
            'subjects' => $subjects,
        ])->layout('components.layouts.app.client-interface', ['client' => $this->client]);
    }

    public function viewLesson($lessonId)
    {
        $this->selectedLesson = LessonModel::with(['subject', 'teacher'])
            ->where('client_id', $this->client->id)
            ->findOrFail($lessonId);
    }

    public function closeModal()
    {
        $this->selectedLesson = null;
    }

    public function markAsCompleted($lessonId)
    {
        $lesson = LessonModel::where('client_id', $this->client->id)
            ->findOrFail($lessonId);
            
        $lesson->update(['status' => LessonStatus::Completed]);
        $this->selectedLesson = $lesson->fresh(['subject', 'teacher']);
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->subjectFilter = '';
        $this->statusFilter = '';
        $this->resetPage();
    }
}
