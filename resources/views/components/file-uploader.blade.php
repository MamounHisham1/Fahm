
@props(['name', 'label', 'accept' => 'image/*', 'maxSize' => 2, 'recommendedSize'])

<div>
    <label for="{{ $name }}" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">{{ $label }}</label>
    <div class="flex items-center space-x-2">
        <input type="file" id="{{ $name }}" wire:model="{{ $name }}" accept="{{ $accept }}"
            class="block w-full px-3 py-2 mt-2 text-sm text-gray-600 bg-white border border-gray-200 rounded-lg file:bg-gray-200 file:text-gray-700 file:text-sm file:px-4 file:py-1 file:border-none file:rounded-full dark:file:bg-gray-800 dark:file:text-gray-200 dark:text-gray-300 placeholder-gray-400/70 dark:placeholder-gray-500 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:focus:border-blue-300 @error($name) border-red-500 @enderror" />
    </div>
    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Recommended size: {{ $recommendedSize }}.
        Max file size: {{ $maxSize }}MB.</p>
    @error($name)
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>