<?php

namespace App\Filament\Widgets;

use App\Enums\UserRole;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class TenantStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $clientId = Auth::user()->client_id;

        return [
            Stat::make('Total Students', User::where('client_id', $clientId)->where('role', UserRole::Student)->count())
                ->description('Enrolled students')
                ->descriptionIcon('heroicon-o-academic-cap')
                ->chart([15, 4, 10, 2, 12, 4, 12])
                ->color('success'),

            Stat::make('Total Teachers', User::where('client_id', $clientId)->where('role', UserRole::Teacher)->count())
                ->description('Teaching staff')
                ->descriptionIcon('heroicon-o-user-group')
                ->chart([3, 2, 5, 1, 4, 2, 6])
                ->color('info'),

            Stat::make('Active Subjects', Subject::where('client_id', $clientId)->count())
                ->description('Available courses')
                ->descriptionIcon('heroicon-o-rectangle-stack')
                ->chart([5, 2, 8, 1, 6, 2, 7])
                ->color('primary'),

            Stat::make('Total Lessons', Lesson::whereHas('subject', function ($query) use ($clientId) {
                $query->where('client_id', $clientId);
            })->count())
                ->description('Learning materials')
                ->descriptionIcon('heroicon-o-play-circle')
                ->chart([10, 5, 12, 3, 8, 4, 15])
                ->color('warning'),

            Stat::make('Classrooms', Classroom::where('client_id', $clientId)->count())
                ->description('Learning groups')
                ->descriptionIcon('heroicon-o-academic-cap')
                ->chart([2, 1, 3, 1, 2, 1, 3])
                ->color('gray'),

            Stat::make('Grade Levels', Grade::where('client_id', $clientId)->count())
                ->description('Academic levels')
                ->descriptionIcon('heroicon-o-star')
                ->chart([1, 1, 2, 1, 1, 1, 2])
                ->color('purple'),
        ];
    }
}
