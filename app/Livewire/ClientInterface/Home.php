<?php

namespace App\Livewire\ClientInterface;

use App\Models\Assignment;
use App\Models\Lesson;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Context;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app.client-interface')]
class Home extends Component
{
    public $client;

    public $viewedLessons;

    public $totalLessons;

    public $weeklyActivity;

    public $upcomingDeadlines;

    public $achievements;

    public $recommendedResources;

    public function mount()
    {
        $this->client = Context::getHidden('client');
        $user = Auth::user();

        $this->viewedLessons = $user?->lessonsViewed()?->where('client_id', $this->client->id)->count() ?? 0;
        $this->totalLessons = Lesson::where('client_id', $this->client->id)->count();

        $this->weeklyActivity = $this->calculateWeeklyActivity($user);

        $this->upcomingDeadlines = $this->getUpcomingDeadlines($user);

        $this->achievements = $this->getAchievements($user);

        $this->recommendedResources = $this->getRecommendedResources($user);
    }

    private function calculateWeeklyActivity($user): array
    {
        if (! $user) {
            return [
                'hours' => 0,
                'trend' => '+0%',
                'recent' => [],
            ];
        }

        $currentWeekViews = $user->lessonsViewed()
            ->where('client_id', $this->client->id)
            ->where('lesson_viewed.created_at', '>=', Carbon::now()->startOfWeek())
            ->count();

        $lastWeekViews = $user->lessonsViewed()
            ->where('client_id', $this->client->id)
            ->whereBetween('lesson_viewed.created_at', [
                Carbon::now()->subWeek()->startOfWeek(),
                Carbon::now()->subWeek()->endOfWeek(),
            ])
            ->count();

        $hours = $currentWeekViews * 0.5;

        $trend = $lastWeekViews > 0
            ? round((($currentWeekViews - $lastWeekViews) / $lastWeekViews) * 100, 1)
            : ($currentWeekViews > 0 ? 100 : 0);

        $recentActivity = $user->lessonsViewed()
            ->where('client_id', $this->client->id)
            ->orderBy('lesson_viewed.created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($view) {
                return [
                    'description' => 'Completed: '.($view->lesson->title ?? 'Lesson'),
                    'time' => $view->created_at->diffForHumans(),
                ];
            })
            ->toArray();

        return [
            'hours' => round($hours, 1),
            'trend' => ($trend >= 0 ? '+' : '').$trend.'%',
            'recent' => $recentActivity,
        ];
    }

    private function getUpcomingDeadlines($user): array
    {
        if (! $user) {
            return [];
        }

        // TODO: Only unsubmitted assignment, using "when()" i guess :)
        $deadlines = Assignment::where('client_id', $this->client->id)
            ->where('due_date', '>=', Carbon::now())
            ->where('due_date', '<=', Carbon::now()->addDays(7))
            ->orderBy('due_date')
            ->take(5)
            ->get()
            ->map(function ($assignment) {
                return [
                    'title' => $assignment->title,
                    'due_date' => $assignment->due_date->format('M j'),
                    'subject' => $assignment->subject->name ?? 'General',
                ];
            })
            ->toArray();

        return $deadlines;
    }

    private function getAchievements($user): array
    {
        if (! $user) {
            return [];
        }

        $achievements = [];

        $completedLessons = $user->lessonsViewed()
            ->where('client_id', $this->client->id)
            ->count();

        if ($completedLessons >= 1) {
            $achievements[] = ['name' => 'First Lesson', 'icon' => '🎯'];
        }
        if ($completedLessons >= 5) {
            $achievements[] = ['name' => 'Lesson Explorer', 'icon' => '🧭'];
        }
        if ($completedLessons >= 10) {
            $achievements[] = ['name' => 'Learning Champion', 'icon' => '🏆'];
        }

        $weeklyViews = $user->lessonsViewed()
            ->where('client_id', $this->client->id)
            ->where('lesson_viewed.created_at', '>=', Carbon::now()->startOfWeek())
            ->count();

        if ($weeklyViews >= 3) {
            $achievements[] = ['name' => 'Consistent Learner', 'icon' => '📅'];
        }

        return $achievements;
    }

    private function getRecommendedResources($user): array
    {
        if (! $user) {
            return [];
        }

        $viewedLessonIds = $user->lessonsViewed()
            ->where('client_id', $this->client->id)
            ->pluck('lesson_id');

        $recommendedLessons = Lesson::where('client_id', $this->client->id)
            ->whereNotIn('id', $viewedLessonIds)
            ->inRandomOrder()
            ->take(3)
            ->get()
            ->map(function ($lesson) {
                return [
                    'title' => $lesson->title,
                    'type' => 'Lesson',
                    'url' => route('client.lessons.show', [$lesson->subject, $lesson]),
                ];
            })
            ->toArray();

        return $recommendedLessons;
    }

    public function render()
    {
        return view('livewire.client-interface.home');
    }
}
