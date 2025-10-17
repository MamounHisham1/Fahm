<?php

namespace App\Filament\Widgets;

use App\Enums\UserRole;
use App\Models\Classroom;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class StudentEnrollmentChart extends ChartWidget
{
    protected static ?string $heading = 'Student Enrollment by Grade';

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        $clientId = Auth::user()->client_id;

        // Get classrooms with their student counts
        $classrooms = Classroom::where('client_id', $clientId)
            ->withCount(['users' => function ($query) {
                $query->where('role', UserRole::Student);
            }])
            ->get();

        $labels = $classrooms->pluck('name')->toArray();
        $data = $classrooms->pluck('users_count')->toArray();

        // If no classrooms, provide default data
        if (empty($labels)) {
            $labels = ['No Classrooms'];
            $data = [0];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Students',
                    'data' => $data,
                    'backgroundColor' => [
                        '#3b82f6', '#10b981', '#8b5cf6', '#f59e0b', '#ef4444',
                        '#06b6d4', '#84cc16', '#f97316', '#6366f1', '#ec4899',
                    ],
                    'borderColor' => '#ffffff',
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false,
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
