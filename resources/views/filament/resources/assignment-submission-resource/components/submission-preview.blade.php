@props(['submission'])

<div class="space-y-4">
    @if($submission)
    <div class="flex items-center justify-between">
        <h4 class="text-sm font-medium text-gray-900">Submission Type: {{ ucfirst($submission->type) }}</h4>
        <span class="text-xs text-gray-500">Submitted: {{ $submission->created_at->format('M d, Y - h:i A') }}</span>
    </div>

    @if($submission->type === 'file' && $submission->file)
        <div class="bg-gray-50 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">
                            {{ basename($submission->file) }}
                        </p>
                    </div>
                </div>
                <a href="{{ Storage::url($submission->file) }}" target="_blank"
                    class="ml-4 inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                </a>
            </div>
        </div>
    @elseif($submission->type === 'text' && $submission->text)
        <div class="bg-gray-50 rounded-lg p-4">
            <div class="flex items-start gap-3">
                <div class="p-2 bg-blue-100 rounded-lg flex-shrink-0 mt-1">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $submission->text }}</p>
                </div>
            </div>
        </div>
    @elseif($submission->type === 'image' && $submission->image)
        <div class="bg-gray-50 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">
                            {{ basename($submission->image) }}
                        </p>
                    </div>
                </div>
                <a href="{{ Storage::url($submission->image) }}" target="_blank"
                    class="ml-4 inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </a>
            </div>
        </div>
    @else
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
                <p class="text-sm text-yellow-700">No submission content available</p>
            </div>
        </div>
    @endif
    @else
        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-sm text-red-700">Submission data not available</p>
            </div>
        </div>
    @endif
</div>