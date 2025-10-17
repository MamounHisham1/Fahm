<?php

namespace App\Filament\Widgets;

use App\Models\Lesson;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class RecentActivityTable extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Recent Activity';

    public function table(Table $table): Table
    {
        $clientId = Auth::user()->client_id;

        return $table
            ->query(
                Lesson::query()
                    ->whereHas('subject', function ($query) use ($clientId) {
                        $query->where('client_id', $clientId);
                    })
                    ->with('subject')
                    ->latest()
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('subject.name')
                    ->label('Subject')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('M j, Y g:i A')
                    ->sortable()
                    ->label('Created'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                        'archived' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->url(fn (Lesson $record): string => route('filament.fahm.resources.lessons.view', $record))
                    ->icon('heroicon-o-eye'),
            ])
            ->emptyStateHeading('No recent activity')
            ->emptyStateDescription('When lessons are created, they will appear here.')
            ->emptyStateIcon('heroicon-o-play-circle');
    }
}
