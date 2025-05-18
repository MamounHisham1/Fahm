<?php

namespace App\Filament\Resources;

use App\Enums\LessonStatus;
use App\Enums\LessonType;
use App\Enums\UserRole;
use App\Filament\Resources\LessonResource\Pages;
use App\Filament\Resources\LessonResource\RelationManagers;
use App\Forms\Components\VideoUploader;
use App\Models\Client;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('client_id')
                    ->relationship('client', 'name')
                    ->required()
                    ->visible(Auth::user()->email == 'admin@admin.com')
                    ->live(),
                Forms\Components\Select::make('user_id')
                    ->label('Teacher')
                    ->required()
                    ->options(function(Get $get) {
                        if($get('client_id')) {
                            return User::where('role', UserRole::Teacher)->where('client_id', $get('client_id'))->pluck('name', 'id');
                        }
                        return User::where('role', UserRole::Teacher)->where('client_id', Auth::user()->client_id)->pluck('name', 'id');
                    }),
                Forms\Components\Select::make('subject_id')
                    ->required()
                    ->options(function(Get $get) {
                        if($get('client_id')) {
                            return Subject::where('client_id', $get('client_id'))->pluck('name', 'id');
                        }
                        return Subject::where('client_id', Auth::user()->client_id)->pluck('name', 'id');
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
                TextColumn::make('client.name')
                    ->visible(Auth::user()->email == 'admin@admin.com')
                    ->searchable(),
                TextColumn::make('subject.name')
                    ->searchable(),
                TextColumn::make('description')
                    ->limit(20)
                    ->searchable(),
                IconColumn::make('status'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->modifyQueryUsing(function (Builder $query): Builder {
                $user = Auth::user();
                $client = $user->client;
                if ($user->email !== 'admin@admin.com') {
                    return $query->where('client_id', $client->id);
                }
                return $query;
            })
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
