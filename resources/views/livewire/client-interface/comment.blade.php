<div>
    @foreach ($alerts as $id => $alert)
        <x-alert position="top-right" :type="$alert['type']" dismissible :wire-id="$id">
            {{ $alert['message'] }}
        </x-alert>
    @endforeach

    <div class="p-6 border-t border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Comments ({{ count($comments) }})</h3>

        @foreach ($comments as $comment)
            <div class="mb-8 last:mb-0 transition-all duration-300">
                <div class="flex items-start space-x-3">
                    {{-- User avatar --}}
                    <div class="flex-shrink-0">
                        <div
                            class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>

                    {{-- Main comment content --}}
                    <div class="flex-1">
                        <div class="flex justify-between items-center mb-1">
                            <h4 class="text-sm font-semibold text-gray-900 tracking-tight">
                                {{ $comment->user->name }}</h4>
                            <span
                                class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>

                        <div
                            class="bg-gray-50 rounded-xl p-4 text-gray-700 text-sm leading-relaxed shadow-sm">
                            {{ $comment->body }}
                        </div>

                        {{-- Replies section --}}
                        @if ($comment->children->count() > 0)
                            <div class="mt-4 ml-6 border-l-2 border-gray-200 pl-4"
                                x-data="{ showReplies: false }">
                                <div class="flex items-center mb-2">
                                    <button
                                        class="text-xs flex items-center text-gray-500 hover:text-gray-700 font-medium"
                                        x-on:click="showReplies = !showReplies">
                                        <svg class="w-3.5 h-3.5 mr-1 transition-transform"
                                            :class="{ 'rotate-90': showReplies, 'rotate-0': !showReplies }" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                        <span
                                            x-text="showReplies ? 'Hide replies' : 'Show replies ({{ $comment->children->count() }})'"></span>
                                    </button>
                                </div>

                                <div x-show="showReplies" x-transition class="space-y-4">
                                    @foreach ($comment->children as $reply)
                                        <div class="flex items-start space-x-3">
                                            <div class="flex-shrink-0">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 shadow">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex justify-between items-center mb-1">
                                                    <div class="flex items-center space-x-2">
                                                        <h4 class="text-sm font-medium text-gray-900">
                                                            {{ $reply->user->name }}</h4>
                                                        <span
                                                            class="inline-flex items-center text-xs text-gray-500">
                                                            <svg class="w-3 h-3 mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                                            </svg>
                                                            Reply
                                                        </span>
                                                    </div>
                                                    <span
                                                        class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                                                </div>

                                                <div
                                                    class="bg-gray-50 rounded-xl p-3 text-sm text-gray-700 border-l-2 border-blue-400 shadow-sm">
                                                    {{ $reply->body }}
                                                </div>

                                                <div class="mt-2 flex justify-between items-center">
                                                    <div class="flex items-center space-x-3">
                                                        <button
                                                            class="text-xs flex items-center text-gray-500 hover:text-gray-700 transition"
                                                            wire:click="like({{ $reply->id }})">
                                                            <svg class="{{ $reply->likes->contains(Auth::id()) ? 'text-red-500 fill-current' : '' }} w-3 h-3 mr-1"
                                                                fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                            </svg>
                                                            {{ $reply->likes->count() }}
                                                        </button>
                                                    </div>
                                                    @if (Auth::check() && $reply->user_id === Auth::user()->id)
                                                        <x-confirmation-alert
                                                            identifier="delete-reply-{{ $reply->id }}"
                                                            title="Delete Reply"
                                                            message="Are you sure you want to delete this reply? This action cannot be undone."
                                                            confirm-method="deleteComment" :confirm-params="[$reply->id]">
                                                            <x-slot name="trigger">
                                                                <button
                                                                    class="text-xs flex items-center text-red-600 hover:text-red-800 transition"
                                                                    x-on:click="$dispatch('open-confirmation-delete-reply-{{ $reply->id }}')">
                                                                    <svg class="w-3 h-3 mr-1" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                    </svg>
                                                                    Delete
                                                                </button>
                                                            </x-slot>
                                                        </x-confirmation-alert>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Actions for parent comment --}}
                        <div class="mt-3 flex justify-between items-center">
                            <div class="flex items-center space-x-4">
                                <button
                                    class="text-xs flex items-center text-blue-600 hover:text-blue-800 transition"
                                    wire:click="replyForm({{ $comment->id }})">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                    </svg>
                                    Reply
                                </button>
                                <button
                                    class="text-xs flex items-center text-gray-500 hover:text-gray-700 transition"
                                    wire:click="like({{ $comment->id }})">
                                    <svg class="{{ $comment->likes->contains(Auth::id()) ? 'text-red-500 fill-current' : '' }} w-3.5 h-3.5 mr-1"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                    Like ({{ $comment->likes->count() }})
                                </button>
                            </div>

                            @if (Auth::check() && $comment->user_id === Auth::user()->id)
                                <x-confirmation-alert identifier="delete-comment-{{ $comment->id }}"
                                    title="Delete Comment"
                                    message="Are you sure you want to delete this comment? This action cannot be undone."
                                    confirm-method="deleteComment" :confirm-params="[$comment->id]">
                                    <x-slot name="trigger">
                                        <button
                                            class="text-xs flex items-center text-red-600 hover:text-red-800 transition"
                                            x-on:click="$dispatch('open-confirmation-delete-comment-{{ $comment->id }}')">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>
                                    </x-slot>
                                </x-confirmation-alert>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Replying textarea --}}
                @if ($replyingForm && $replyingTo === $comment->id)
                    <div
                        class="my-4 ml-14 bg-gray-50/50 rounded-lg p-4 border border-gray-100 shadow-sm">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="text-xs text-gray-500 mb-2">
                                    Replying to <span
                                        class="font-medium text-gray-700">{{ $comment->user->name }}</span>
                                </div>
                                <textarea rows="3"
                                    class="w-full px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="Write your reply here..." wire:model="replayText"></textarea>
                                <div class="mt-2 flex justify-end space-x-2">
                                    <button wire:click="cancelReply"
                                        class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Cancel
                                    </button>
                                    <button wire:click="reply({{ $comment->id }})"
                                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                        </svg>
                                        Post Reply
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach


        @if (count($comments) === 0)
            <div class="text-center py-6">
                <div
                    class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-100 mb-4">
                    <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <p class="text-gray-500">No comments yet. Be the first to share your thoughts!</p>
            </div>
        @endif

        <!-- Comment Form -->
        <div class="mt-6 pt-4 border-t border-gray-200">
            <h4 class="text-sm font-medium text-gray-900 mb-3">Add a comment</h4>
            <div class="flex items-start">
                <div class="flex-shrink-0 mr-3">
                    <div
                        class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <textarea rows="3"
                        class="w-full px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Write your comment here..." wire:model="comment"></textarea>
                    <div class="mt-2 flex justify-end">
                        <button wire:click="addComment"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Post Comment
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
