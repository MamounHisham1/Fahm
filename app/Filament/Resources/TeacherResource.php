<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Filament\Resources\TeacherResource\RelationManagers;
use App\Forms\Components\Relationship;
use App\Models\Profile;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class TeacherResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $modelLabel = 'Teacher';

    protected static ?string $pluralModelLabel = 'Teachers';

    protected static ?string $tenantOwnershipRelationship = 'teachers';

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function canEdit($record): bool
    {
        return $record->client_id === Auth::user()->client_id;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('user_information')
                        ->label('User Information')
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('email')
                                ->email()
                                ->required()
                                ->maxLength(255),
                            Select::make('client_id')
                                ->relationship('client', 'name')
                                ->required()
                                ->visible(Auth::user()->email == 'admin@admin.com'),
                        ]),
                    Wizard\Step::make('profile_information')
                        ->label('Profile Information')
                        ->schema([
                            Relationship::make('profile')->schema([
                                Select::make('gender')
                                    ->options([
                                        'male' => 'Male',
                                        'female' => 'Female',
                                    ])
                                    ->required(),
                                FileUpload::make('avatar')
                                    ->image(),
                                TextInput::make('phone')
                                    ->tel(),
                                TextInput::make('address'),
                                RichEditor::make('bio')
                            ]),
                        ]),
                ])
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('profile.avatar')
                    ->label('Avatar')
                    ->circular()
                    ->default('https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name)),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('profile.gender')
                    ->label('Gender')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => ucfirst($state))
                    ->color(fn(string $state): string => match ($state) {
                        'male' => 'info',
                        'female' => 'danger',
                        default => 'secondary',
                    }),
                TextColumn::make('client.name')
                    ->visible(Auth::user()->email == 'admin@admin.com')
                    ->searchable(),
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
                return $query->where('role', 'teacher')->where('client_id', $user->client_id);
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
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('profile');
    }
}
