<?php

namespace App\Filament\Resources\AssignmentSubmissionResource\Pages;

use App\Filament\Resources\AssignmentSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssignmentSubmissions extends ListRecords
{
    protected static string $resource = AssignmentSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
