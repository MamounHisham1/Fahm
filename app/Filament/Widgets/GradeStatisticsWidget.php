<?php

namespace App\Filament\Widgets;

use App\Models\AssignmentGrade;
use Filament\Widgets\ChartWidget;

class GradeStatisticsWidget extends ChartWidget
{
    protected static ?string $heading = 'Grade Distribution';

    protected function getData(): array
    {
        $grades = AssignmentGrade::all();

        $gradeRanges = [
            '90-100' => 0,
            '80-89' => 0,
            '70-79' => 0,
            '60-69' => 0,
            'Below 60' => 0,
        ];

        foreach ($grades as $grade) {
            $score = $grade->score;

            if ($score >= 90) {
                $gradeRanges['90-100']++;
            } elseif ($score >= 80) {
                $gradeRanges['80-89']++;
            } elseif ($score >= 70) {
                $gradeRanges['70-79']++;
            } elseif ($score >= 60) {
                $gradeRanges['60-69']++;
            } else {
                $gradeRanges['Below 60']++;
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Number of Grades',
                    'data' => array_values($gradeRanges),
                    'backgroundColor' => [
                        '#10b981', // Green for 90-100
                        '#3b82f6', // Blue for 80-89
                        '#f59e0b', // Yellow for 70-79
                        '#f97316', // Orange for 60-69
                        '#ef4444', // Red for Below 60
                    ],
                ],
            ],
            'labels' => array_keys($gradeRanges),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
