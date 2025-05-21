@props(['name', 'label', 'type' => 'text', 'value' => null, 'required' => false, 'info' => null])
<div>
    <label for="{{ $name }}" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">{{ $label }} <span class="text-red-500">{{ $required ? '*' : '' }}</span></label>
    <input type="{{ $type }}" {{ $required ? 'required' : '' }} wire:model="{{ $name }}" class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 @error($name) border-red-500 @enderror">
    @if ($info)
        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $info }}</p>
    @endif
</div>

@error($name)
    <p class="text-red-500">{{ $message }}</p>
@enderror
