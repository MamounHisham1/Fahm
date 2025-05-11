<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ __('Lessons') }}
                </h1>
                <p class="mt-1 text-gray-600 dark:text-gray-300">
                    {{ __('Browse and access your learning materials') }}
                </p>
            </div>
            <div class="flex items-center gap-3">
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
                <div>
                    <select 
                        wire:model.live="subjectFilter" 
                        class="border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 py-2 pl-3 pr-10 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                        <option value="">{{ __('All Subjects') }}</option>
                        @foreach($subjects ?? [] as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select 
                        wire:model.live="statusFilter" 
                        class="border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 py-2 pl-3 pr-10 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                        <option value="">{{ __('All Statuses') }}</option>
                        <option value="pending">{{ __('Pending') }}</option>
                        <option value="in_progress">{{ __('In Progress') }}</option>
                        <option value="completed">{{ __('Completed') }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Lessons Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($lessons ?? [] as $lesson)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow duration-200">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm font-medium px-2.5 py-0.5 rounded-full 
                            @if($lesson->status->value === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                            @elseif($lesson->status->value === 'in_progress') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                            @elseif($lesson->status->value === 'completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                            @endif">
                            {{ $lesson->status->getLabel() }}
                        </span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $lesson->subject->name }}</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $lesson->title }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-2">{{ $lesson->description }}</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">{{ $lesson->teacher->name }}</span>
                        </div>
                        <button 
                            wire:click="viewLesson({{ $lesson->id }})"
                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            {{ __('View') }}
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-8 text-center">
                <div class="inline-flex items-center justify-center p-3 bg-blue-100 dark:bg-blue-900 rounded-full mb-4">
                    <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">{{ __('No lessons found') }}</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">{{ __('There are no lessons matching your criteria.') }}</p>
                @if($search || $subjectFilter || $statusFilter)
                    <button 
                        wire:click="resetFilters"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 dark:text-blue-300 dark:bg-blue-900 dark:hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        {{ __('Clear filters') }}
                    </button>
                @endif
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if(isset($lessons) && $lessons->hasPages())
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4">
            {{ $lessons->links() }}
        </div>
    @endif

    <!-- Lesson Detail Modal -->
    @if($selectedLesson)
        <div class="fixed inset-0 bg-black/50 dark:bg-gray-900/80 flex items-center justify-center z-50 p-4">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $selectedLesson->title }}</h3>
                    <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="text-sm font-medium px-2.5 py-0.5 rounded-full 
                            @if($selectedLesson->status->value === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                            @elseif($selectedLesson->status->value === 'in_progress') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                            @elseif($selectedLesson->status->value === 'completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                            @endif">
                            {{ $selectedLesson->status->getLabel() }}
                        </span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $selectedLesson->subject->name }}</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('Teacher') }}: {{ $selectedLesson->teacher->name }}</span>
                    </div>
                    
                    <div class="prose prose-blue max-w-none dark:prose-invert mb-6">
                        {!! $selectedLesson->description !!}
                    </div>
                    
                    <div class="flex justify-end gap-3 mt-6">
                        @if($selectedLesson->status->value !== 'completed')
                            <button 
                                wire:click="markAsCompleted({{ $selectedLesson->id }})"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                            >
                                {{ __('Mark as Completed') }}
                            </button>
                        @endif
                        <button 
                            wire:click="closeModal"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            {{ __('Close') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
