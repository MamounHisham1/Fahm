<div class="space-y-8">
    <!-- Header Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    {{ __('Assignments') }}
                </h1>
                <p class="mt-1 text-gray-600">
                    {{ __('View and manage your assignments') }}
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <div class="relative">
                    <input type="text" wire:model.live.debounce.300ms="search"
                        placeholder="{{ __('Search assignments...') }}"
                        class="w-full md:w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <div class="absolute left-3 top-2.5 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                <select wire:model.live="subjectFilter"
                    class="border border-gray-300 rounded-lg bg-white text-gray-900 py-2 pl-3 pr-10 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">{{ __('All Subjects') }}</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
                <select wire:model.live="statusFilter"
                    class="border border-gray-300 rounded-lg bg-white text-gray-900 py-2 pl-3 pr-10 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">{{ __('All Status') }}</option>
                    <option value="pending">{{ __('Pending') }}</option>
                    <option value="submitted">{{ __('Submitted') }}</option>
                    <option value="graded">{{ __('Graded') }}</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Assignments Grid -->
    <div class="grid grid-cols-1 gap-6">
        @forelse($assignments as $assignment)
            <a href="{{ route('client.assignments.show', $assignment->id) }}" wire:navigate
                class="block group bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-200 transform hover:-translate-y-1 cursor-pointer">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-4">
                            <h2
                                class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                {{ $assignment->title }}
                            </h2>
                            @if ($assignment->submissions()->where('user_id', Auth::id())->exists())
                                @php $submission = $assignment->submissions()->where('user_id', request()->user()->id())->first() @endphp
                                @if ($submission->grades->isNotEmpty())
                                    <span
                                        class="inline-flex items-center gap-1 text-sm font-medium text-blue-800 bg-blue-100 px-2.5 py-1 rounded-full">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ __('Graded') }}
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 text-sm font-medium text-green-800 bg-green-100 px-2.5 py-1 rounded-full">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        {{ __('Submitted') }}
                                    </span>
                                @endif
                            @elseif($assignment->due_date && $assignment->due_date->isPast())
                                <span
                                    class="text-sm text-gray-500 bg-red-100 px-2.5 py-0.5 rounded-md">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ __('Overdue') }}
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center gap-1 text-sm font-medium text-amber-800 bg-amber-100 px-2.5 py-1 rounded-full">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ __('Pending') }}
                                </span>
                            @endif
                        </div>
                        <div class="flex items-center gap-2">
                            <span
                                class="text-sm text-gray-500 bg-gray-100 px-2.5 py-0.5 rounded-md">
                                {{ $assignment->subject->name }}
                            </span>
                        </div>
                    </div>

                    <p class="text-gray-600 mb-4">
                        {{ Str::limit($assignment->description, 200) }}
                    </p>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4 text-sm text-gray-500">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-medium">{{ __('Due') }}:</span>
                                <span
                                    class="ml-1">{{ $assignment->due_date ? $assignment->due_date->format('M d, Y - h:i A') : __('No due date') }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="font-medium">{{ $assignment->submissions->count() }}</span>
                                <span class="ml-1">{{ __('Submissions') }}</span>
                            </div>
                        </div>
                        <span
                            class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-white bg-blue-600 group-hover:bg-blue-700 transition-colors">
                            {{ __('View Assignment') }}
                            <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                    </div>
                </div>
            </a>
        @empty
            <div class="text-center py-12">
                <div
                    class="inline-flex items-center justify-center p-3 bg-blue-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('No assignments found') }}
                </h3>
                <p class="text-gray-500 mb-6">
                    {{ __('No assignments match your current filters.') }}
                </p>
                @if ($search || $subjectFilter || $statusFilter)
                    <button wire:click="resetFilters"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        {{ __('Clear filters') }}
                    </button>
                @endif
            </div>
        @endforelse

        @if ($assignments->hasPages())
            <div class="mt-6">
                {{ $assignments->links() }}
            </div>
        @endif
    </div>
</div>
