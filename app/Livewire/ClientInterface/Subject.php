<?php

namespace App\Livewire\ClientInterface;

use App\Models\Client;
use App\Models\Subject as SubjectModel;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app.client-interface')]
class Subject extends Component
{
    use WithPagination;

    public $client;
    public $search = '';

    public function mount(Client $client)
    {
        $this->client = $client;
    }

    public function render()
    {
        $subjects = SubjectModel::where('client_id', $this->client->id)
            ->when($this->search, function ($query) {
                return $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->withCount('lessons')
            ->orderBy('name')
            ->paginate(12);

        return view('livewire.client-interface.subject', [
            'subjects' => $subjects,
        ])->layout('components.layouts.app.client-interface', ['client' => $this->client]);
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->resetPage();
    }
}