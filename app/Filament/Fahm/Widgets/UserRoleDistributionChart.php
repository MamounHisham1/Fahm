<?php

namespace App\Filament\Fahm\Widgets;

use App\Enums\UserRole;
use App\Models\User;
use Filament\Widgets\ChartWidget;

class UserRoleDistributionChart extends ChartWidget
{
    protected static ?string $heading = 'User Role Distribution';

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getData(): array
    {
        $studentCount = User::where('role', UserRole::Student)->count();
        $teacherCount = User::where('role', UserRole::Teacher)->count();
        $adminCount = User::where('role', UserRole::Admin)->count();

        return [
            'datasets' => [
                [
                    'label' => 'User Roles',
                    'data' => [$studentCount, $teacherCount, $adminCount],
                    'backgroundColor' => [
                        '#10b981', // Green for students
                        '#8b5cf6', // Purple for teachers
                        '#f59e0b', // Amber for admins
                    ],
                    'borderColor' => '#ffffff',
                    'borderWidth' => 2,
                ],
            ],
            'labels' => ['Students', 'Teachers', 'Admins'],
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
                'tooltip' => [
                    'callbacks' => [
                        'label' => 'function(context) { return context.label + ": " + context.parsed + " users"; }',
                    ],
                ],
            ],
        ];
    }
}
