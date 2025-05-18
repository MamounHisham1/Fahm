<?php

namespace App\Livewire\ClientInterface;

use App\Enums\LessonStatus;
use App\Models\Client;
use App\Models\Lesson as LessonModel;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Context;
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

    public function mount(Subject $subject, LessonModel $lesson)
    {
        $this->client = Context::getHidden('client');
        $this->subject = $subject;
        
        if ($lesson->client_id !== $this->client->id) {
            abort(404);
        }
        
        if(!$this->subject->lessons->contains($lesson)) {
            abort(404);
        }
        $this->selectedLesson = $lesson;

        if(!Auth::user()->lessonsViewed()->where('lesson_id', $lesson->id)->exists()) {
            Auth::user()->lessonsViewed()->attach($lesson);
        }
    }

    public function render()
    {
        $lessons = LessonModel::where('client_id', $this->client->id)
            ->where('subject_id', $this->subject->id)
            ->when($this->search, function ($query) {
                return $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->with(['teacher'])
            ->orderBy('created_at', 'asc')
            ->paginate(30);

        return view('livewire.client-interface.lesson', ['lessons' => $lessons]);
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->resetPage();
    }
}
