<?php

namespace App\Filament\Fahm\Resources;

use App\Filament\Fahm\Resources\ClientResource\Pages;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationGroup = 'System';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Client Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter client name'),
                        Forms\Components\TextInput::make('domain')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter subdomain (e.g., school-name)')
                            ->helperText('This will be used for subdomain routing: school-name.fahm.test'),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Additional Information')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->maxLength(500)
                            ->rows(3)
                            ->placeholder('Optional description of the client'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                Client::query()
                    ->withCount(['students', 'teachers', 'subjects'])
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),

                Tables\Columns\TextColumn::make('domain')
                    ->searchable()
                    ->sortable()
                    ->label('Subdomain')
                    ->copyable()
                    ->copyMessage('Subdomain copied!')
                    ->copyMessageDuration(1500),

                Tables\Columns\TextColumn::make('students_count')
                    ->label('Students')
                    ->sortable()
                    ->alignCenter()
                    ->color('success')
                    ->icon('heroicon-o-academic-cap'),

                Tables\Columns\TextColumn::make('teachers_count')
                    ->label('Teachers')
                    ->sortable()
                    ->alignCenter()
                    ->color('info')
                    ->icon('heroicon-o-user-group'),

                Tables\Columns\TextColumn::make('subjects_count')
                    ->label('Subjects')
                    ->sortable()
                    ->alignCenter()
                    ->color('warning')
                    ->icon('heroicon-o-rectangle-stack'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->label('Created'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->label('Updated')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('has_students')
                    ->label('Has Students')
                    ->query(fn (Builder $query): Builder => $query->has('students')),
                Tables\Filters\Filter::make('has_teachers')
                    ->label('Has Teachers')
                    ->query(fn (Builder $query): Builder => $query->has('teachers')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('view_dashboard')
                    ->label('Dashboard')
                    ->url(fn (Client $record): string => route('filament.fahm.pages.dashboard', ['domain' => $record->domain]))
                    ->icon('heroicon-o-chart-bar')
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'view' => Pages\ViewClient::route('/{record}'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
