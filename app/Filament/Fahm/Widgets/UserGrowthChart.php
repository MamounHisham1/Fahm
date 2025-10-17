<?php

namespace App\Filament\Fahm\Widgets;

use App\Enums\UserRole;
use App\Models\User;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class UserGrowthChart extends ChartWidget
{
    protected static ?string $heading = 'User Growth Over Time';

    protected static ?string $pollingInterval = '30s';

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        // Get user growth data for the last 6 months
        $userData = Trend::model(User::class)
            ->between(
                start: now()->subMonths(6),
                end: now(),
            )
            ->perMonth()
            ->count();

        // Get student growth data
        $studentData = Trend::query(
            User::where('role', UserRole::Student)
        )
            ->between(
                start: now()->subMonths(6),
                end: now(),
            )
            ->perMonth()
            ->count();

        // Get teacher growth data
        $teacherData = Trend::query(
            User::where('role', UserRole::Teacher)
        )
            ->between(
                start: now()->subMonths(6),
                end: now(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Total Users',
                    'data' => $userData->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'fill' => true,
                ],
                [
                    'label' => 'Students',
                    'data' => $studentData->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'fill' => true,
                ],
                [
                    'label' => 'Teachers',
                    'data' => $teacherData->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => '#8b5cf6',
                    'backgroundColor' => 'rgba(139, 92, 246, 0.1)',
                    'fill' => true,
                ],
            ],
            'labels' => $userData->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
        ];
    }
}
