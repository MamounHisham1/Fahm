<?php

namespace App\Filament\Widgets;

use App\Models\AssignmentSubmission;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class SubmissionTrendsWidget extends ChartWidget
{
    protected static ?string $heading = 'Submission Trends (Last 7 Days)';

    protected function getData(): array
    {
        $submissions = AssignmentSubmission::where('created_at', '>=', Carbon::now()->subDays(7))
            ->get()
            ->groupBy(function ($submission) {
                return $submission->created_at->format('Y-m-d');
            });

        $dates = [];
        $counts = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $dates[] = Carbon::parse($date)->format('M j');
            $counts[] = $submissions->get($date, collect())->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Submissions',
                    'data' => $counts,
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $dates,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
