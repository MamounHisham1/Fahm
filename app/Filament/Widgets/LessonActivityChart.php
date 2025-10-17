<?php

namespace App\Filament\Widgets;

use App\Models\Lesson;
use App\Models\Subject;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\Auth;

class LessonActivityChart extends ChartWidget
{
    protected static ?string $heading = 'Lesson Activity Over Time';

    protected static ?string $pollingInterval = '30s';

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $clientId = Auth::user()->client_id;

        // Get lesson creation data for the last 3 months
        $lessonData = Trend::model(Lesson::class)
            ->between(
                start: now()->subMonths(3),
                end: now(),
            )
            ->perWeek()
            ->whereHas('subject', function ($query) use ($clientId) {
                $query->where('client_id', $clientId);
            })
            ->count();

        // Get subject creation data for comparison
        $subjectData = Trend::model(Subject::class)
            ->between(
                start: now()->subMonths(3),
                end: now(),
            )
            ->perWeek()
            ->where('client_id', $clientId)
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Lessons Created',
                    'data' => $lessonData->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
                [
                    'label' => 'Subjects Created',
                    'data' => $subjectData->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $lessonData->map(fn (TrendValue $value) => $value->date),
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
