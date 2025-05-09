<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Resources\TeacherResource;
use App\Models\Profile;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTeacher extends EditRecord
{
    protected static string $resource = TeacherResource::class;

    protected function afterFill()
    {
        $this->data['profile'] = $this->record->profile?->toArray() ?? [];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // $profile = Profile::where('user_id', $this->record->id)->firstOrFail();
        // $profile->update($data['profile']);
        // unset($data['profile']);
        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
