<?php

namespace App\Livewire\ClientInterface;

use App\Models\Client;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app.client-interface')]
class Assignment extends Component
{
    public $client;
    public $search = '';
    public $subjectFilter = '';
    public $statusFilter = '';
    public $selectedAssignment = null;
    public $submissionText = '';
    public $attachments = [];

    public function mount(Client $client)
    {
        $this->client = $client;
    }

    public function render()
    {
        return view('livewire.client-interface.assignment')
            ->layout('components.layouts.app.client-interface', ['client' => $this->client]);
    }
}
