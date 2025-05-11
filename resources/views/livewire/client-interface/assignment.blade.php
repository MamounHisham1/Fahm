<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ __('Assignments') }}
                </h1>
                <p class="mt-1 text-gray-600 dark:text-gray-300">
                    {{ __('View and complete your assigned tasks') }}
                </p>
            </div>
            <div class="flex items-center gap-3">
                <div class="relative">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search" 
                        placeholder="{{ __('Search assignments...') }}"
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
                        <option value="submitted">{{ __('Submitted') }}</option>
                        <option value="graded">{{ __('Graded') }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Assignments Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($assignments ?? [] as $assignment)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow duration-200">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm font-medium px-2.5 py-0.5 rounded-full 
                            @if($assignment->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                            @elseif($assignment->status === 'in_progress') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                            @elseif($assignment->status === 'submitted') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300
                            @elseif($assignment->status === 'graded') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                            @endif">
                            {{ ucfirst($assignment->status) }}
                        </span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $assignment->subject->name ?? 'General' }}</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $assignment->title }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-2">{{ $assignment->description }}</p>
                    
                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-4">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Due: {{ $assignment->due_date ? $assignment->due_date->format('M d, Y') : 'No due date' }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">{{ $assignment->teacher->name ?? 'Teacher' }}</span>
                        </div>
                        <button 
                            wire:click="viewAssignment({{ $assignment->id ?? 0 }})"
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">{{ __('No assignments found') }}</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">{{ __('There are no assignments matching your criteria.') }}</p>
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
    @if(isset($assignments) && $assignments->hasPages())
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4">
            {{ $assignments->links() }}
        </div>
    @endif

    <!-- Assignment Detail Modal -->
    @if($selectedAssignment)
        <div class="fixed inset-0 bg-black/50 dark:bg-gray-900/80 flex items-center justify-center z-50 p-4">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $selectedAssignment->title }}</h3>
                    <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-6">
                    <div class="flex flex-wrap items-center gap-4 mb-6">
                        <span class="text-sm font-medium px-2.5 py-0.5 rounded-full 
                            @if($selectedAssignment->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                            @elseif($selectedAssignment->status === 'in_progress') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                            @elseif($selectedAssignment->status === 'submitted') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300
                            @elseif($selectedAssignment->status === 'graded') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                            @endif">
                            {{ ucfirst($selectedAssignment->status) }}
                        </span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $selectedAssignment->subject->name ?? 'General' }}</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('Teacher') }}: {{ $selectedAssignment->teacher->name ?? 'Teacher' }}</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Due: {{ $selectedAssignment->due_date ? $selectedAssignment->due_date->format('M d, Y') : 'No due date' }}
                        </span>
                    </div>
                    
                    <div class="prose prose-blue max-w-none dark:prose-invert mb-6">
                        {!! $selectedAssignment->description !!}
                    </div>
                    
                    @if($selectedAssignment->status === 'graded' && isset($selectedAssignment->grade))
                        <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <h4 class="font-medium text-gray-900 dark:text-white mb-2">{{ __('Feedback') }}</h4>
                            <div class="flex items-center mb-3">
                                <div class="text-2xl font-bold text-gray-900 dark:text-white mr-3">{{ $selectedAssignment->grade->score ?? 'N/A' }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">/ {{ $selectedAssignment->grade->max_score ?? '100' }}</div>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300">{{ $selectedAssignment->grade->feedback ?? 'No feedback provided.' }}</p>
                        </div>
                    @endif
                    
                    @if($selectedAssignment->status !== 'graded' && $selectedAssignment->status !== 'submitted')
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-900 dark:text-white mb-3">{{ __('Submit Your Work') }}</h4>
                            <div class="space-y-4">
                                <div>
                                    <label for="submission" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('Your Answer') }}</label>
                                    <textarea 
                                        id="submission" 
                                        wire:model="submissionText" 
                                        rows="4" 
                                        class="w-full rounded-md border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="{{ __('Type your answer here...') }}"
                                    ></textarea>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('Attachments (optional)') }}</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-700 border-dashed rounded-md">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                                <label for="file-upload" class="relative cursor-pointer bg-white dark:bg-gray-800 rounded-md font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 focus-within:outline-none">
                                                    <span>{{ __('Upload a file') }}</span>
                                                    <input id="file-upload" wire:model="attachments" type="file" class="sr-only" multiple>
                                                </label>
                                                <p class="pl-1">{{ __('or drag and drop') }}</p>
                                            </div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ __('PNG, JPG, PDF up to 10MB') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <div class="flex justify-end gap-3 mt-6">
                        @if($selectedAssignment->status !== 'graded' && $selectedAssignment->status !== 'submitted')
                            <button 
                                wire:click="submitAssignment({{ $selectedAssignment->id ?? 0 }})"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                            >
                                {{ __('Submit Assignment') }}
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
