<?php

namespace App\Livewire\ClientInterface;

use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Context;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app.client-interface')]
class Home extends Component
{
    public $client;

    public $viewedLessons;

    public $totalLessons;

    public function mount()
    {
        $this->client = Context::getHidden('client');
        $this->viewedLessons = Auth::user()?->lessonsViewed()?->where('client_id', $this->client->id)->count() ?? 0;
        $this->totalLessons = Lesson::count();
    }

    public function render()
    {
        return view('livewire.client-interface.home');
    }
}
