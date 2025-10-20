<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AssignmentStatsWidget;
use App\Filament\Widgets\GradeStatisticsWidget;
use App\Filament\Widgets\SubmissionTrendsWidget;
use App\Models\Assignment;
use App\Models\AssignmentGrade;
use App\Models\AssignmentSubmission;
use App\Models\User;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            AssignmentStatsWidget::class,
        ];
    }

    public function getWidgets(): array
    {
        return [
            StatsOverviewWidget::make()
                ->stats([
                    Stat::make('Average Grade', $this->getAverageGrade().'/100')
                        ->description('Average score across all graded assignments')
                        ->descriptionIcon('heroicon-o-academic-cap')
                        ->color('success'),

                    Stat::make('Total Students', User::where('role', 'student')->count())
                        ->description('Students registered in the system')
                        ->descriptionIcon('heroicon-o-user-group')
                        ->color('primary'),

                    Stat::make('Pending Grading', $this->getPendingGradingCount())
                        ->description('Submissions waiting to be graded')
                        ->descriptionIcon('heroicon-o-clock')
                        ->color('danger'),

                    Stat::make('Grading Rate', $this->getGradingRate().'%')
                        ->description('Percentage of submissions that have been graded')
                        ->descriptionIcon('heroicon-o-chart-pie')
                        ->color('warning'),
                ]),
            GradeStatisticsWidget::class,
            SubmissionTrendsWidget::class,
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

    private function getAverageGrade(): float
    {
        $averageScore = AssignmentGrade::avg('score');

        if ($averageScore === null) {
            return 0;
        }

        return round($averageScore, 1);
    }

    private function getPendingGradingCount(): int
    {
        return AssignmentSubmission::doesntHave('grades')->count();
    }

    private function getGradingRate(): float
    {
        $totalSubmissions = AssignmentSubmission::count();
        $gradedSubmissions = AssignmentSubmission::has('grades')->count();

        if ($totalSubmissions === 0) {
            return 0;
        }

        return round(($gradedSubmissions / $totalSubmissions) * 100, 1);
    }
}
