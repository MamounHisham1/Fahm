<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    {{ __('Lectures') }}
                </h1>
                <p class="mt-1 text-gray-600">
                    {{ __('Watch and participate in live and recorded lectures') }}
                </p>
            </div>
            <div class="flex items-center gap-3">
                <div class="relative">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search" 
                        placeholder="{{ __('Search lectures...') }}"
                        class="w-full md:w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
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
                        class="border border-gray-300 rounded-lg bg-white text-gray-900 py-2 pl-3 pr-10 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                        <option value="">{{ __('All Subjects') }}</option>
                        @foreach($subjects ?? [] as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select 
                        wire:model.live="typeFilter" 
                        class="border border-gray-300 rounded-lg bg-white text-gray-900 py-2 pl-3 pr-10 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                        <option value="">{{ __('All Types') }}</option>
                        <option value="live">{{ __('Live') }}</option>
                        <option value="recorded">{{ __('Recorded') }}</option>
                        <option value="upcoming">{{ __('Upcoming') }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Live Lectures Section (if any) -->
    @if(isset($upcomingLectures) && count($upcomingLectures) > 0)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Upcoming Live Lectures') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($upcomingLectures as $lecture)
                    <div class="bg-blue-50 rounded-lg p-4 border border-blue-100">
                        <div class="flex items-center justify-between mb-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <span class="relative flex h-2 w-2 mr-1">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                                </span>
                                {{ __('Live') }}
                            </span>
                            <span class="text-xs text-gray-500">{{ $lecture->subject->name ?? 'General' }}</span>
                        </div>
                        <h3 class="text-md font-medium text-gray-900 mb-1">{{ $lecture->title }}</h3>
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $lecture->scheduled_at ? $lecture->scheduled_at->format('M d, Y - h:i A') : 'TBD' }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-7 h-7 rounded-full bg-gray-200 flex items-center justify-center text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <span class="ml-2 text-xs text-gray-600">{{ $lecture->teacher->name ?? 'Instructor' }}</span>
                            </div>
                            <button 
                                wire:click="joinLecture({{ $lecture->id ?? 0 }})"
                                class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            >
                                {{ __('Join') }}
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Lectures Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($lectures ?? [] as $lecture)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                <div class="relative">
                    <div class="aspect-video bg-gray-200 flex items-center justify-center">
                        @if($lecture->thumbnail)
                            <img src="{{ $lecture->thumbnail }}" alt="{{ $lecture->title }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        @endif
                        
                        <!-- Play button overlay -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-16 h-16 rounded-full bg-black/50 flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Duration badge -->
                        <div class="absolute bottom-2 right-2 px-2 py-1 bg-black/70 text-white text-xs rounded">
                            {{ $lecture->duration ?? '45:00' }}
                        </div>
                    </div>
                    
                    <!-- Live badge if applicable -->
                    @if($lecture->type === 'live')
                        <div class="absolute top-2 left-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            <span class="relative flex h-2 w-2 mr-1">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                            </span>
                            {{ __('Live Now') }}
                        </div>
                    @elseif($lecture->type === 'upcoming')
                        <div class="absolute top-2 left-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ __('Upcoming') }}
                        </div>
                    @endif
                </div>
                
                <div class="p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-500">{{ $lecture->subject->name ?? 'General' }}</span>
                        <span class="text-xs text-gray-500">{{ $lecture->created_at ? $lecture->created_at->format('M d, Y') : 'Jan 1, 2023' }}</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $lecture->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $lecture->description }}</p>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <span class="ml-2 text-sm text-gray-600">{{ $lecture->teacher->name ?? 'Instructor' }}</span>
                        </div>
                        <button 
                            wire:click="viewLecture({{ $lecture->id ?? 0 }})"
                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            {{ __('Watch') }}
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                <div class="inline-flex items-center justify-center p-3 bg-blue-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('No lectures found') }}</h3>
                <p class="text-gray-500 mb-6">{{ __('There are no lectures matching your criteria.') }}</p>
                @if($search || $subjectFilter || $typeFilter)
                    <button 
                        wire:click="resetFilters"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        {{ __('Clear filters') }}
                    </button>
                @endif
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if(isset($lectures) && $lectures->hasPages())
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
            {{ $lectures->links() }}
        </div>
    @endif

    <!-- Lecture Video Modal -->
    @if($selectedLecture)
        <div class="fixed inset-0 bg-black/80 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-900">{{ $selectedLecture->title }}</h3>
                    <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <!-- Video Player -->
                <div class="aspect-video bg-black">
                    @if($selectedLecture->video_url)
                        <iframe 
                            src="{{ $selectedLecture->video_url }}" 
                            class="w-full h-full" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen
                        ></iframe>
                    @else
                        <div class="w-full h-full flex items-center justify-center text-white">
                            <p>{{ __('Video not available') }}</p>
                        </div>
                    @endif
                </div>
                
                <div class="p-6">
                    <div class="flex flex-wrap items-center gap-4 mb-4">
                        <span class="text-sm text-gray-500">{{ $selectedLecture->subject->name ?? 'General' }}</span>
                        <span class="text-sm text-gray-500">{{ __('Instructor') }}: {{ $selectedLecture->teacher->name ?? 'Instructor' }}</span>
                        <span class="text-sm text-gray-500">{{ __('Duration') }}: {{ $selectedLecture->duration ?? '45:00' }}</span>
                    </div>
                    
                    <div class="prose prose-blue max-w-none mb-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-2">{{ __('About this lecture') }}</h4>
                        <p>{!! $selectedLecture->description !!}</p>
                    </div>
                    
                    <!-- Resources Section -->
                    @if(isset($selectedLecture->resources) && count($selectedLecture->resources) > 0)
                        <div class="mt-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-3">{{ __('Resources') }}</h4>
                            <div class="space-y-2">
                                @foreach($selectedLecture->resources as $resource)
                                    <a 
                                        href="{{ $resource->url ?? '#' }}" 
                                        target="_blank" 
                                        class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50"
                                    >
                                        <div class="flex-shrink-0 mr-3">
                                            <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                                                <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $resource->title ?? 'Lecture Notes' }}</p>
                                            <p class="text-xs text-gray-500">{{ $resource->type ?? 'PDF' }} • {{ $resource->size ?? '2.4 MB' }}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <div class="flex justify-end mt-6">
                        <button 
                            wire:click="closeModal"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            {{ __('Close') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
    <!-- Live Lecture Join Modal -->
    @if($joiningLecture)
        <div class="fixed inset-0 bg-black/80 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-md w-full">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-900">{{ __('Join Live Lecture') }}</h3>
                    <button wire:click="closeJoinModal" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-6">
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-900 mb-2">{{ $joiningLecture->title }}</h4>
                        <p class="text-sm text-gray-600 mb-4">{{ $joiningLecture->description }}</p>
                        
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $joiningLecture->scheduled_at ? $joiningLecture->scheduled_at->format('M d, Y - h:i A') : 'Starting now' }}</span>
                        </div>
                        
                        <div class="bg-blue-50 p-4 rounded-lg mb-4">
                            <div class="flex items-center text-blue-800">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-medium">{{ __('Before joining') }}</span>
                            </div>
                            <ul class="mt-2 text-sm text-blue-700 space-y-1 pl-7 list-disc">
                                <li>{{ __('Test your audio and video') }}</li>
                                <li>{{ __('Ensure a stable internet connection') }}</li>
                                <li>{{ __('Find a quiet environment') }}</li>
                            </ul>
                        </div>
                        
                        <div class="flex items-center mb-4">
                            <input 
                                id="camera" 
                                type="checkbox" 
                                wire:model="enableCamera" 
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                            >
                            <label for="camera" class="ml-2 text-sm font-medium text-gray-900">{{ __('Enable camera') }}</label>
                        </div>
                        
                        <div class="flex items-center">
                            <input 
                                id="microphone" 
                                type="checkbox" 
                                wire:model="enableMicrophone" 
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                            >
                            <label for="microphone" class="ml-2 text-sm font-medium text-gray-900">{{ __('Enable microphone') }}</label>
                        </div>
                    </div>
                    
                    <div class="flex justify-end gap-3">
                        <button 
                            wire:click="closeJoinModal"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            {{ __('Cancel') }}
                        </button>
                        <button 
                            wire:click="startLiveSession"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            {{ __('Join Now') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
