<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Welcome back, {{ auth()->user()->name }}!
                </h1>
                <p class="mt-1 text-gray-600 dark:text-gray-300">
                    Here's an overview of your learning progress
                </p>
            </div>
            <div class="hidden sm:block">
                <x-button href="#" variant="primary">
                    Continue Learning
                </x-button>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Course Progress -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between">
                <div class="inline-flex items-center justify-center p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $courseProgress['completed'] ?? 0 }}/{{ $courseProgress['total'] ?? 0 }}</span>
            </div>
            <h3 class="mt-4 text-sm font-medium text-gray-900 dark:text-white">Courses Completed</h3>
            <div class="mt-2 h-1.5 w-full bg-gray-200 rounded-full overflow-hidden">
                <div class="h-full bg-blue-600 rounded-full" style="width: {{ ($courseProgress['completed'] ?? 0) / ($courseProgress['total'] ?? 1) * 100 }}%"></div>
            </div>
        </div>

        <!-- Weekly Activity -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between">
                <div class="inline-flex items-center justify-center p-2 bg-green-100 dark:bg-green-900 rounded-lg">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $weeklyActivity['hours'] ?? 0 }}h</span>
            </div>
            <h3 class="mt-4 text-sm font-medium text-gray-900 dark:text-white">Weekly Activity</h3>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $weeklyActivity['trend'] ?? '+2.5%' }} vs last week</p>
        </div>

        <!-- Upcoming Deadlines -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between">
                <div class="inline-flex items-center justify-center p-2 bg-red-100 dark:bg-red-900 rounded-lg">
                    <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ count($upcomingDeadlines ?? []) }}</span>
            </div>
            <h3 class="mt-4 text-sm font-medium text-gray-900 dark:text-white">Upcoming Deadlines</h3>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Next due: {{ $upcomingDeadlines[0]['due_date'] ?? 'None' }}</p>
        </div>

        <!-- Achievements -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between">
                <div class="inline-flex items-center justify-center p-2 bg-purple-100 dark:bg-purple-900 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>
                <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ count($achievements ?? []) }}</span>
            </div>
            <h3 class="mt-4 text-sm font-medium text-gray-900 dark:text-white">Achievements Earned</h3>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Latest: {{ $achievements[0]['name'] ?? 'None' }}</p>
        </div>
    </div>

    <!-- Recent Activity & Recommended Resources -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Activity -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Activity</h2>
            <div class="space-y-4">
                @forelse($weeklyActivity['recent'] ?? [] as $activity)
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                {{ $activity['description'] ?? 'Completed Lesson' }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $activity['time'] ?? '2 hours ago' }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400 text-sm">No recent activity</p>
                @endforelse
            </div>
        </div>

        <!-- Recommended Resources -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recommended Resources</h2>
            <div class="space-y-4">
                @forelse($recommendedResources ?? [] as $resource)
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-lg bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                {{ $resource['title'] ?? 'Introduction to Course' }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $resource['type'] ?? 'Course' }} • {{ $resource['duration'] ?? '2h 30m' }}
                            </p>
                        </div>
                        <div>
                            <a href="{{ $resource['url'] ?? '#' }}" class="inline-flex items-center px-2.5 py-1.5 border border-gray-300 dark:border-gray-600 shadow-sm text-xs font-medium rounded text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Start
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400 text-sm">No recommendations available</p>
                @endforelse
            </div>
        </div>
    </div>
</div>