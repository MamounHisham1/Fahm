<?php

namespace App\Filament\Resources\LessonResource\Pages;

use App\Filament\Resources\LessonResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateLesson extends CreateRecord
{
    protected static string $resource = LessonResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (! isset($data['client_id'])) {
            $data['client_id'] = Auth::user()->client->id;
        }

        if (isset($data['video']) && is_array($data['video'])) {
            $data['url'] = $data['url'] ?? $data['video']['url'] ?? null;
            $data['public_id'] = $data['video']['public_id'] ?? null;
        }

        unset($data['video']);

        return $data;
    }
}
