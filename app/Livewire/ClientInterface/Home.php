<?php

namespace App\Livewire\ClientInterface;

use App\Models\Client;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app.client-interface')]
class Home extends Component
{
    public $client;

    public function mount(Client $client)
    {
        $this->client = $client;
    }
    
    public function render()
    {
        return view('livewire.client-interface.home')
            ->layout('components.layouts.app.client-interface', ['client' => $this->client]);
    }
}
