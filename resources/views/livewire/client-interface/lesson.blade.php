<div class="space-y-8">
    <!-- Header Section -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ $subject->name }}
                </h1>
                <p class="mt-1 text-gray-600 dark:text-gray-300">
                    {{ __('Browse lessons for this subject') }}
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <div class="relative">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search" 
                        placeholder="{{ __('Search lessons...') }}"
                        class="w-full md:w-64 pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                    <div class="absolute left-3 top-2.5 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Lessons Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 sticky top-4 max-h-[calc(100vh-2rem)] overflow-y-auto">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('Lessons') }}</h2>
                <div class="space-y-2">
                    @forelse($lessons as $lesson)
                        <a 
                            href="{{ route('client.lessons.show', ['client' => $client, 'subject' => $subject, 'lesson' => $lesson]) }}" 
                            wire:navigate
                            class="block w-full text-left px-3 py-2 rounded-lg transition-colors {{ $selectedLesson && $selectedLesson->id == $lesson->id ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300' : 'hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300' }}"
                        >
                            <div class="flex flex-col">
                                <div class="flex items-center justify-between">
                                    <span class="font-medium line-clamp-1">{{ $lesson->title }}</span>
                                    
                                    @if(route('client.lessons.show', ['client' => $client, 'subject' => $subject, 'lesson' => $lesson]) == request()->url())
                                        <span class="text-xs px-2 py-0.5 rounded-full bg-indigo-100 text-indigo-800 dark:bg-indigo-900/60 dark:text-indigo-300 font-medium">
                                            Current
                                        </span>
                                    @elseif($lesson->views()->where('user_id', Auth::user()->id)->exists())
                                        <span class="text-xs px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300 font-medium">
                                            Viewed
                                        </span>
                                    @endif
                                </div>
                                <div class="flex items-center justify-between mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    <div class="flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ $lesson->teacher->name }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $lesson->duration ?? '15 min' }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="text-gray-500 dark:text-gray-400 text-center py-4">
                            {{ __('No lessons found') }}
                        </div>
                    @endforelse
                </div>
                
                <!-- Pagination -->
                @if($lessons->hasPages())
                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                        {{ $lessons->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Current Lesson Display -->
        <div class="lg:col-span-3">
            @if($selectedLesson)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="aspect-video bg-gray-900 w-full relative">
                        @if($selectedLesson && $selectedLesson->public_id)
                            <livewire:video-player :videoPublicId="$selectedLesson->public_id" />
                            <livewire:client-interface.comment :lesson="$selectedLesson" />
                        @else
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center">
                                    <div class="w-16 h-16 rounded-full bg-blue-600/20 flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <p class="text-white text-sm">{{ __('No video available for this lesson') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Lesson Content -->
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $selectedLesson->title }}</h2>
                        </div>
                        
                        <div class="flex items-center gap-4 mb-6 text-sm text-gray-500 dark:text-gray-400">
                            <div class="flex items-center">
                                <div class="w-6 h-6 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300 mr-2">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                {{ $selectedLesson->teacher->name }}
                            </div>
                            <div>{{ $selectedLesson->created_at->format('M d, Y') }}</div>
                        </div>
                        
                        <div class="prose prose-blue max-w-none dark:prose-invert mb-6">
                            {!! $selectedLesson->description !!}
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-8 text-center h-full flex items-center justify-center">
                    <div>
                        <div class="inline-flex items-center justify-center p-3 bg-blue-100 dark:bg-blue-900 rounded-full mb-4">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">{{ __('Select a lesson') }}</h3>
                        <p class="text-gray-500 dark:text-gray-400">{{ __('Choose a lesson from the sidebar to start learning.') }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>