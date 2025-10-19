<?php

namespace App\Filament\Resources\AssignmentSubmissionResource\Pages;

use App\Filament\Resources\AssignmentSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssignmentSubmission extends EditRecord
{
    protected static string $resource = AssignmentSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
