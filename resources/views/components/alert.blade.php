@props([
    'type' => 'info',
    'dismissible' => false,
    'icon' => null,
    'title' => null,
    'wireId' => null,
    'position' => null
])

@php
    $classes = match ($type) {
        'success' => 'bg-green-50 text-green-800 dark:bg-green-900 dark:text-green-300 border-green-200 dark:border-green-800',
        'error' => 'bg-red-50 text-red-800 dark:bg-red-900/50 dark:text-red-300 border-red-200 dark:border-red-800',
        'warning' => 'bg-yellow-50 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300 border-yellow-200 dark:border-yellow-800',
        'info' => 'bg-blue-50 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300 border-blue-200 dark:border-blue-800',
        default => 'bg-gray-50 text-gray-800 dark:bg-gray-900/50 dark:text-gray-300 border-gray-200 dark:border-gray-800',
    };

    $iconSvg = match ($type) {
        'success' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>',
        'error' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>',
        'warning' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>',
        'info' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zm-1 4a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>',
        default => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zm-1 4a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>',
    };
    
    $positionClasses = match ($position) {
        'top' => 'fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md',
        'top-right' => 'fixed top-4 right-4 z-50 w-full max-w-md',
        'top-left' => 'fixed top-4 left-4 z-50 w-full max-w-md',
        'bottom' => 'fixed bottom-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md',
        'bottom-right' => 'fixed bottom-4 right-4 z-50 w-full max-w-md',
        'bottom-left' => 'fixed bottom-4 left-4 z-50 w-full max-w-md',
        default => '',
    };
    
    $alpineAttributes = $wireId 
        ? "x-data=\"{ show: true }\" x-show=\"show\" x-init=\"setTimeout(() => { show = false; \$wire.clearAlert('{$wireId}') }, 5000)\""
        : "x-data=\"{ show: true }\" x-show=\"show\"";
@endphp

<div 
    {{ $attributes->merge(['class' => "rounded-lg border p-4 mb-4 {$classes} {$positionClasses}"]) }}
    {!! $alpineAttributes !!}
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-95"
    x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-95"
>
    <div class="flex items-start">
        @if($icon !== false)
            <div class="flex-shrink-0 mr-3">
                @if($icon)
                    {!! $icon !!}
                @else
                    {!! $iconSvg !!}
                @endif
            </div>
        @endif
        
        <div class="flex-1">
            @if($title)
                <h3 class="text-sm font-medium mb-1">{{ $title }}</h3>
            @endif
            
            <div class="text-sm">
                {{ $slot }}
            </div>
        </div>
        
        @if($dismissible)
            <button 
                type="button"
                class="ml-auto -mx-1.5 -my-1.5 rounded-lg p-1.5 inline-flex h-8 w-8 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 dark:focus:ring-offset-gray-800"
                x-on:click="show = false; {{ $wireId ? "\$wire.clearAlert('{$wireId}')" : '' }}"
                aria-label="Dismiss"
            >
                <span class="sr-only">Dismiss</span>
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        @endif
    </div>
</div>