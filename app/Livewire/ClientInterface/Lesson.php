<?php

namespace App\Livewire\ClientInterface;

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

        abort_if($lesson->client_id !== $this->client->id, 404);

        abort_if(! $this->subject->lessons->contains($lesson), 404);

        $this->selectedLesson = $lesson;

        $this->markAsViewed($lesson);
    }

    public function render()
    {
        $lessons = $this->getLessonsWithSearchQuery();

        return view('livewire.client-interface.lesson', ['lessons' => $lessons]);
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->resetPage();
    }

    private function markAsViewed(LessonModel $lesson)
    {
        if (! Auth::user()->lessonsViewed()->where('lesson_id', $lesson->id)->exists()) {
            Auth::user()->lessonsViewed()->attach($lesson);
        }
    }

    private function getLessonsWithSearchQuery()
    {
        return LessonModel::where('client_id', $this->client->id)
        ->where('subject_id', $this->subject->id)
        ->when($this->search, function ($query) {
            return $query->where('title', 'like', '%'.$this->search.'%');
        })
        ->with(['teacher'])
        ->orderBy('created_at', 'asc')
        ->paginate(30);
    }
}
