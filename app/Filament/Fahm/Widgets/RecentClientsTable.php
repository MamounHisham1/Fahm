<?php

namespace App\Filament\Fahm\Widgets;

use App\Models\Client;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentClientsTable extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Recent Clients';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Client::query()
                    ->withCount(['students', 'teachers', 'subjects'])
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('domain')
                    ->searchable()
                    ->sortable()
                    ->label('Subdomain'),

                Tables\Columns\TextColumn::make('students_count')
                    ->label('Students')
                    ->sortable()
                    ->alignCenter()
                    ->color('success'),

                Tables\Columns\TextColumn::make('teachers_count')
                    ->label('Teachers')
                    ->sortable()
                    ->alignCenter()
                    ->color('info'),

                Tables\Columns\TextColumn::make('subjects_count')
                    ->label('Subjects')
                    ->sortable()
                    ->alignCenter()
                    ->color('warning'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->label('Created'),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->url(fn (Client $record): string => route('filament.dashboard.resources.clients.view', $record))
                    ->icon('heroicon-o-eye'),
            ])
            ->emptyStateHeading('No clients yet')
            ->emptyStateDescription('When clients are created, they will appear here.')
            ->emptyStateIcon('heroicon-o-building-office');
    }
}
