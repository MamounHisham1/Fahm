<?php

namespace App\Filament\Resources\LessonResource\Pages;

use App\Filament\Resources\LessonResource;
use App\Models\Lesson;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLesson extends CreateRecord
{
    protected static string $resource = LessonResource::class;

    // public function mount(): void
    // {
    //     if (app()->isLocal()) {
    //         $this->form->fill(Lesson::factory()->make()->toArray());
    //     }
    // }
}
