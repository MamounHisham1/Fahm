<div class="space-y-8">
    <!-- Header Section -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ $assignment->title }}
                    </h1>
                    <span @class([
                        'px-2.5 py-0.5 rounded-full text-xs font-medium',
                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' => $assignment->status === 'pending',
                        'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' => $assignment->status === 'submitted',
                        'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' => $assignment->status === 'graded',
                    ])>
                        {{ ucfirst($assignment->status) }}
                    </span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2.5 py-0.5 rounded-md">
                        {{ $assignment->subject->name }}
                    </span>
                    @if($assignment->due_date)
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            •
                        </span>
                        <span class="text-sm text-gray-500 dark:text-gray-400 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $assignment->due_date->format('M d, Y - h:i A') }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Assignment Details -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <div class="prose prose-blue max-w-none dark:prose-invert">
                    {!! $assignment->description !!}
                </div>
            </div>

            @if($submission && $submission->grades->isNotEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('Feedback') }}</h2>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="flex items-center gap-2">
                            <span class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $submission->grades->first()->score }}
                            </span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                / {{ $submission->grades->first()->max_score }}
                            </span>
                        </div>
                        <div class="h-8 w-px bg-gray-200 dark:bg-gray-700"></div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            {{ __('Graded') }} {{ $submission->grades->first()->created_at->diffForHumans() }}
                        </div>
                    </div>
                    @if($submission->grades->first()->feedback)
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                            <p class="text-gray-600 dark:text-gray-300">
                                {{ $submission->grades->first()->feedback }}
                            </p>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Submission Form or Submission Details -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 sticky top-6">
                @if($assignment->status === 'pending' && !$submission)
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('Submit Your Work') }}</h2>
                    <form wire:submit="submitAssignment" class="space-y-4">
                        <div class="space-y-3">
                            <label class="flex items-center p-3 gap-3 rounded-lg border border-gray-200 dark:border-gray-700 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors" :class="{ 'bg-blue-50 dark:bg-blue-900/30 border-blue-200 dark:border-blue-800': $wire.type === 'file' }">
                                <input type="radio" name="type" wire:model="type" value="file" class="text-blue-600 focus:ring-blue-500">
                                <div>
                                    <span class="block text-sm font-medium text-gray-900 dark:text-white">{{ __('File Upload') }}</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">{{ __('Upload a document, image, or PDF file') }}</span>
                                </div>
                            </label>
                            
                            <label class="flex items-center p-3 gap-3 rounded-lg border border-gray-200 dark:border-gray-700 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors" :class="{ 'bg-blue-50 dark:bg-blue-900/30 border-blue-200 dark:border-blue-800': $wire.type === 'text' }">
                                <input type="radio" name="type" wire:model="type" value="text" class="text-blue-600 focus:ring-blue-500">
                                <div>
                                    <span class="block text-sm font-medium text-gray-900 dark:text-white">{{ __('Text Submission') }}</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">{{ __('Write your submission directly') }}</span>
                                </div>
                            </label>
                        </div>

                        <div x-show="$wire.type === 'file'" class="mt-4">
                            <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg hover:border-gray-400 dark:hover:border-gray-500 transition-colors">
                                <div class="space-y-2 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">
                                        <label for="file-upload" class="relative cursor-pointer rounded-md font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>{{ __('Upload a file') }}</span>
                                            <input id="file-upload" wire:model="file" type="file" class="sr-only">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ __('PDF, DOC, DOCX up to 10MB') }}
                                    </p>
                                </div>
                            </div>
                            @error('file') <span class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                        </div>

                        <div x-show="$wire.type === 'text'" class="mt-4">
                            <x-textarea 
                                name="text"
                                label="{{ __('Submission Text') }}"
                                placeholder="{{ __('Enter your submission text here...') }}"
                                class="block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300 sm:text-sm"></x-textarea>
                            @error('text')
                            <span class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ __('Submit Assignment') }}
                        </button>
                    </form>
                @else
                    <!-- For submitted or graded assignments, or when already submitted but not graded -->
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('Your Submission') }}</h2>
                    
                    @if($submission)
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ __('Submitted') }}</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $submission->created_at->format('M d, Y - h:i A') }}</span>
                            </div>

                            @if($submission->type === 'file')
                                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="p-2 bg-blue-100 dark:bg-blue-900/50 rounded-lg">
                                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                                    {{ basename($submission->file) }}
                                                </p>
                                            </div>
                                        </div>
                                        <a href="{{ Storage::url($submission->file) }}" target="_blank" 
                                            class="ml-4 inline-flex items-center text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @elseif($submission->type === 'text')
                                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                                    <div class="flex items-start gap-3">
                                        <div class="p-2 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex-shrink-0 mt-1">
                                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm text-gray-700 dark:text-gray-300 whitespace-pre-wrap">{{ $submission->text }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($assignment->status === 'submitted')
                                <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                                    <div class="flex items-center gap-3">
                                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-sm text-blue-700 dark:text-blue-300">
                                            {{ __('Your submission is being reviewed by the instructor.') }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="text-center py-4">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                {{ __('No submission found for this assignment.') }}
                            </p>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
