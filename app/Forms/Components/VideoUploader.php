<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Field;

class VideoUploader extends Field
{
    protected string $view = 'forms.components.video-uploader';
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->afterStateHydrated(function (VideoUploader $component, $state) {
            if (is_string($state)) {
                $component->state(json_decode($state, true) ?? $state);
            }
        });
    }
}
