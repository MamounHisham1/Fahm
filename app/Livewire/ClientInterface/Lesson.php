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
    public $subject;
    
    public $search = '';
    public $selectedLesson = null;

    public function mount(Client $client, Subject $subject)
    {
        $this->client = $client;
        $this->subject = $subject;
    }

    public function render()
    {
        $lessons = LessonModel::where('client_id', $this->client->id)
            ->where('subject_id', $this->subject->id)
            ->where('status', LessonStatus::Completed)
            ->when($this->search, function ($query) {
                return $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->with(['teacher'])
            ->latest()
            ->get();

        return view('livewire.client-interface.lesson', ['lessons' => $lessons])
            ->layout('components.layouts.app.client-interface', ['client' => $this->client]);
    }

    public function viewLesson($lessonId)
    {
        $this->selectedLesson = LessonModel::with(['subject', 'teacher'])
            ->where('client_id', $this->client->id)
            ->findOrFail($lessonId);
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->resetPage();
    }
}
