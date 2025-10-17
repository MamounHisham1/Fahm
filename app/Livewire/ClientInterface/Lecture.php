<?php

namespace App\Livewire\ClientInterface;

use Illuminate\Support\Facades\Context;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app.client-interface')]
class Lecture extends Component
{
    public $client;

    public $search = '';

    public $subjectFilter = '';

    public $typeFilter = '';

    public $selectedLecture = null;

    public $joiningLecture = null;

    public $enableCamera = true;

    public $enableMicrophone = true;

    public function mount()
    {
        $this->client = Context::getHidden('client');
    }

    public function render()
    {
        return view('livewire.client-interface.lecture')
            ->layout('components.layouts.app.client-interface', ['client' => $this->client]);
    }
}
