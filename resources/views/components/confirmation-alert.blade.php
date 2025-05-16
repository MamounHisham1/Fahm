@props([
    'title' => 'Confirm Action',
    'message' => 'Are you sure you want to proceed?',
    'confirmText' => 'Confirm',
    'cancelText' => 'Cancel',
    'confirmMethod' => '',
    'confirmParams' => [],
    'identifier' => '',
    'confirmButtonClass' => 'bg-red-600 hover:bg-red-700',
    'cancelButtonClass' => 'bg-gray-500 hover:bg-gray-600'
])

<div
    x-data="{ 
        open: false,
        toggle() { this.open = !this.open },
        close() { this.open = false }
    }"
    x-on:open-confirmation-{{ $identifier }}.window="open = true"
    x-on:close-confirmation-{{ $identifier }}.window="open = false"
    class="relative"
>
    {{ $trigger }}

    <!-- Modal backdrop -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-40 bg-gray-900/50 dark:bg-gray-900/60"
        x-on:click="close"
        style="display: none;"
    ></div>

    <!-- Modal dialog -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
        style="display: none;"
    >
        <div
            x-on:click.stop
            class="w-full max-w-md overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow-xl"
        >
            <div class="p-5">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                    {{ $title }}
                </h3>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    {{ $message }}
                </p>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-5 py-4 flex justify-end space-x-3">
                <button
                    type="button"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white {{ $cancelButtonClass }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                    x-on:click="close"
                >
                    {{ $cancelText }}
                </button>
                <button
                    type="button"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white {{ $confirmButtonClass }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                    x-on:click="close(); $wire.{{ $confirmMethod }}({{ is_array($confirmParams) ? implode(', ', $confirmParams) : $confirmParams }})"
                >
                    {{ $confirmText }}
                </button>
            </div>
        </div>
    </div>
</div>
