<?php

namespace App\Livewire;

use Livewire\Component;

class VideoPlayer extends Component
{
    public $videoPublicId;

    public $cloudName;

    public function mount()
    {
        $this->cloudName = env('CLOUDINARY_CLOUD_NAME');
    }

    public function render()
    {
        return view('livewire.video-player');
    }
}
