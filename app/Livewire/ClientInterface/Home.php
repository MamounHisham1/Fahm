<?php

namespace App\Livewire\ClientInterface;

use App\Models\Client;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app.client-interface')]
class Home extends Component
{
    public $client;
    public $viewedLessons;
    public $totalLessons;
    public function mount(Client $client)
    {
        $this->client = $client;
        $this->viewedLessons = Auth::user()->lessonsViewed()->count();
        $this->totalLessons = Lesson::where('client_id', $this->client->id)->count();
    }
    
    public function render()
    {
        return view('livewire.client-interface.home',)
            ->layout('components.layouts.app.client-interface', ['client' => $this->client]);
    }
}
