<?php

namespace App\Filament\Resources\ClassroomResource\Pages;

use App\Filament\Resources\ClassroomResource;
use Filament\Resources\Pages\CreateRecord;

class CreateClassroom extends CreateRecord
{
    protected static string $resource = ClassroomResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['client_id'] = request()->user()->client_id;

        return $data;
    }
}
