<div>
    @foreach($alerts as $id => $alert)
        <x-alert 
            position="top-right"
            :type="$alert['type']" 
            dismissible 
            :wire-id="$id"
        >
            {{ $alert['message'] }}
        </x-alert>
    @endforeach
    
    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Comments ({{ count($comments) }})</h3>
        
        @foreach ($comments as $comment)
            <div class="mb-6 last:mb-0">
                <div class="flex items-start">
                    <div class="flex-shrink-0 mr-3">
                        <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-1">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">{{ $comment->user->name }}</h4>
                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-3 text-gray-700 dark:text-gray-300 text-sm">
                            {{ $comment->body }}
                        </div>
                        
                        @if($comment->children->count() > 0)
                            <div class="mt-4 ml-6 space-y-4">
                                @foreach($comment->children as $reply)
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 mr-3">
                                            <div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-1">
                                                <h4 class="text-sm font-medium text-gray-900 dark:text-white">{{ $reply->user->name }}</h4>
                                                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $reply->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-3 text-gray-700 dark:text-gray-300 text-sm">
                                                {{ $reply->body }}
                                            </div>
                                            
                                            @if(Auth::check() && $reply->user_id === Auth::user()->id)
                                                <div class="mt-2 flex justify-end">
                                                    <x-confirmation-alert
                                                        identifier="delete-reply-{{ $reply->id }}"
                                                        title="Delete Reply"
                                                        message="Are you sure you want to delete this reply? This action cannot be undone."
                                                        confirm-method="deleteComment"
                                                        :confirm-params="[$reply->id]"
                                                    >
                                                        <x-slot name="trigger">
                                                            <button 
                                                                type="button"
                                                                class="text-xs text-red-600 dark:text-red-400 hover:underline"
                                                                x-on:click="$dispatch('open-confirmation-delete-reply-{{ $reply->id }}')">
                                                                Delete
                                                            </button>
                                                        </x-slot>
                                                    </x-confirmation-alert>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        
                        <div class="mt-2 flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <button class="text-xs text-blue-600 dark:text-blue-400 hover:underline" wire:click="replyForm({{ $comment->id }})">Reply</button>
                                <button class="text-xs text-gray-500 dark:text-gray-400 hover:underline">Like</button>
                            </div>
                            
                            @if(Auth::check() && $comment->user_id === Auth::user()->id)
                                <x-confirmation-alert
                                    identifier="delete-comment-{{ $comment->id }}"
                                    title="Delete Comment"
                                    message="Are you sure you want to delete this comment? This action cannot be undone."
                                    confirm-method="deleteComment"
                                    :confirm-params="[$comment->id]"
                                >
                                    <x-slot name="trigger">
                                        <button 
                                            type="button"
                                            class="text-xs text-red-600 dark:text-red-400 hover:underline"
                                            x-on:click="$dispatch('open-confirmation-delete-comment-{{ $comment->id }}')">
                                            Delete
                                        </button>
                                    </x-slot>
                                </x-confirmation-alert>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            @if($replyingForm && $replyingTo === $comment->id)
                <div class="mt-4 ml-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mr-3">
                            <div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <textarea 
                                rows="3" 
                                class="w-full px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="Write your reply here..."
                                wire:model="replayText"></textarea>
                            <div class="mt-2 flex justify-end space-x-2">
                                <button 
                                    wire:click="cancelReply"
                                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Cancel
                                </button>
                                <button 
                                    wire:click="reply({{ $comment->id }})"
                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Post Reply
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        
        @if(count($comments) === 0)
            <div class="text-center py-6">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-800 mb-4">
                    <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <p class="text-gray-500 dark:text-gray-400">No comments yet. Be the first to share your thoughts!</p>
            </div>
        @endif
        
        <!-- Comment Form -->
        <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
            <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-3">Add a comment</h4>
            <div class="flex items-start">
                <div class="flex-shrink-0 mr-3">
                    <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <textarea 
                        rows="3" 
                        class="w-full px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Write your comment here..."
                        wire:model="comment"></textarea>
                    <div class="mt-2 flex justify-end">
                        <button 
                            wire:click="addComment"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Post Comment
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
