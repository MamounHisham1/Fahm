@props(['name', 'label', 'placeholder' => '', 'rows' => 4])
<div>
    <label for="{{ $name }}" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">{{ $label }}</label>
    <textarea id="{{ $name }}" wire:model="{{ $name }}" rows="{{ $rows }}"
        class="block mt-2 w-full placeholder-gray-400/70 dark:placeholder-gray-500 rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300 @error($name) border-red-500 @enderror"
        placeholder="{{ $placeholder }}">{{ old($name) }}</textarea>
    @error($name)
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>