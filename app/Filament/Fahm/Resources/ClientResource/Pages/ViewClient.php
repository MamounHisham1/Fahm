<?php

namespace App\Filament\Fahm\Resources\ClientResource\Pages;

use App\Filament\Fahm\Resources\ClientResource;
use Filament\Actions;
use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewClient extends ViewRecord
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\Action::make('view_dashboard')
                ->label('View Dashboard')
                ->url(fn (): string => route('filament.fahm.pages.dashboard', ['domain' => $this->record->domain]))
                ->icon('heroicon-o-chart-bar')
                ->openUrlInNewTab(),
            Actions\DeleteAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make('Client Information')
                    ->schema([
                        Components\TextEntry::make('name')
                            ->label('Client Name'),
                        Components\TextEntry::make('domain')
                            ->label('Subdomain')
                            ->copyable()
                            ->copyMessage('Subdomain copied!')
                            ->copyMessageDuration(1500),
                        Components\TextEntry::make('description')
                            ->label('Description')
                            ->placeholder('No description provided'),
                    ])
                    ->columns(2),

                Components\Section::make('Statistics')
                    ->schema([
                        Components\Grid::make(3)
                            ->schema([
                                Components\TextEntry::make('students_count')
                                    ->label('Total Students')
                                    ->numeric()
                                    ->icon('heroicon-o-academic-cap')
                                    ->color('success'),
                                Components\TextEntry::make('teachers_count')
                                    ->label('Total Teachers')
                                    ->numeric()
                                    ->icon('heroicon-o-user-group')
                                    ->color('info'),
                                Components\TextEntry::make('subjects_count')
                                    ->label('Total Subjects')
                                    ->numeric()
                                    ->icon('heroicon-o-rectangle-stack')
                                    ->color('warning'),
                            ]),
                    ]),

                Components\Section::make('System Information')
                    ->schema([
                        Components\TextEntry::make('created_at')
                            ->label('Created')
                            ->dateTime('M j, Y g:i A'),
                        Components\TextEntry::make('updated_at')
                            ->label('Last Updated')
                            ->dateTime('M j, Y g:i A'),
                    ])
                    ->columns(2),
            ]);
    }
}
