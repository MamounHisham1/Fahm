<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Enums\UserRole;
use App\Filament\Resources\TeacherResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateTeacher extends CreateRecord
{
    protected static string $resource = TeacherResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['password'] = Hash::make(Str::password(16, symbols: false));
        $data['role'] = UserRole::Teacher;
        return $data;
    }
}
