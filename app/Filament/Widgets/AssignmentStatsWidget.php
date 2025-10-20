<?php

namespace App\Filament\Widgets;

use App\Models\Assignment;
use App\Models\AssignmentGrade;
use App\Models\AssignmentSubmission;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AssignmentStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Assignments', Assignment::count())
                ->description('All assignments in the system')
                ->descriptionIcon('heroicon-o-document-text')
                ->color('primary'),

            Stat::make('Total Submissions', AssignmentSubmission::count())
                ->description('All assignment submissions')
                ->descriptionIcon('heroicon-o-inbox')
                ->color('success'),

            Stat::make('Graded Assignments', AssignmentGrade::count())
                ->description('Assignments that have been graded')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('warning'),

            Stat::make('Submission Rate', $this->getSubmissionRate().'%')
                ->description('Percentage of assignments with submissions')
                ->descriptionIcon('heroicon-o-chart-bar')
                ->color('info'),
        ];
    }

    private function getSubmissionRate(): float
    {
        $totalAssignments = Assignment::count();
        $assignmentsWithSubmissions = Assignment::has('submissions')->count();

        if ($totalAssignments === 0) {
            return 0;
        }

        return round(($assignmentsWithSubmissions / $totalAssignments) * 100, 1);
    }
}
