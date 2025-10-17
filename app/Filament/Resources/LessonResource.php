<?php

namespace App\Filament\Resources;

use App\Enums\LessonType;
use App\Enums\UserRole;
use App\Filament\Resources\LessonResource\Pages;
use App\Forms\Components\VideoUploader;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Teacher')
                    ->required()
                    ->options(function () {
                        return User::where('role', UserRole::Teacher)->where('client_id', request()->user()->client_id)->pluck('name', 'id');
                    }),
                Forms\Components\Select::make('subject_id')
                    ->label('Subject')
                    ->required()
                    ->options(function () {
                        return Subject::where('client_id', request()->user()->client_id)->pluck('name', 'id');
                    }),
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\RichEditor::make('description')
                    ->required(),
                Forms\Components\Select::make('type')
                    ->required()
                    ->options(LessonType::class)
                    ->live(),
                VideoUploader::make('video')
                    ->visible(fn (Get $get) => $get('type') == LessonType::Video->value)
                    ->required(),
                Forms\Components\TextInput::make('url')
                    ->visible(fn (Get $get) => $get('type') == LessonType::Youtube->value)
                    ->required()
                    ->label('Youtube URL')
                    ->prefix('https://'),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('subject.name')
                    ->searchable(),
                TextColumn::make('teacher.name')
                    ->searchable(),
                TextColumn::make('type')
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->clientData()
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLessons::route('/'),
            'create' => Pages\CreateLesson::route('/create'),
            'edit' => Pages\EditLesson::route('/{record}/edit'),
        ];
    }
}
