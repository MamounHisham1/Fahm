<?php

namespace App\Filament\Widgets;

use App\Models\Subject;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class SubjectPopularityChart extends ChartWidget
{
    protected static ?string $heading = 'Subject Popularity';

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getData(): array
    {
        $clientId = Auth::user()->client_id;

        // Get subjects with their lesson counts
        $subjects = Subject::where('client_id', $clientId)
            ->withCount('lessons')
            ->orderBy('lessons_count', 'desc')
            ->limit(8)
            ->get();

        $labels = $subjects->pluck('name')->toArray();
        $data = $subjects->pluck('lessons_count')->toArray();

        // If no subjects, provide default data
        if (empty($labels)) {
            $labels = ['No Subjects'];
            $data = [0];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Number of Lessons',
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
                    'display' => true,
                    'position' => 'bottom',
                ],
                'tooltip' => [
                    'callbacks' => [
                        'label' => 'function(context) { return context.label + ": " + context.parsed + " lessons"; }',
                    ],
                ],
            ],
        ];
    }
}
