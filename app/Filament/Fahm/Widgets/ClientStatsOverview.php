<?php

namespace App\Filament\Fahm\Widgets;

use App\Enums\UserRole;
use App\Models\Client;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ClientStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Clients', Client::count())
                ->description('Active educational institutions')
                ->descriptionIcon('heroicon-o-building-office')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('primary'),

            Stat::make('Total Students', User::where('role', UserRole::Student)->count())
                ->description('Registered students across all clients')
                ->descriptionIcon('heroicon-o-academic-cap')
                ->chart([15, 4, 10, 2, 12, 4, 12])
                ->color('success'),

            Stat::make('Total Teachers', User::where('role', UserRole::Teacher)->count())
                ->description('Active teaching staff')
                ->descriptionIcon('heroicon-o-user-group')
                ->chart([3, 2, 5, 1, 4, 2, 6])
                ->color('info'),

            Stat::make('Active Admins', User::where('role', UserRole::Admin)->count())
                ->description('Client administrators')
                ->descriptionIcon('heroicon-o-shield-check')
                ->chart([1, 2, 1, 1, 2, 1, 2])
                ->color('warning'),
        ];
    }
}
