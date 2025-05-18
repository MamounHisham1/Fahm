<div class="flex items-center hidden sm:block">
    <img 
        src="{{ asset('logos/no-bg-logo.png') }}" 
        alt="Logo" 
        class="w-20 h-18 mix-blend-multiply dark:mix-blend-normal dark:opacity-100 transition-all duration-200"
    >

    {{-- <div class="ms-2 grid flex-1 text-start hidden md:block">
        <span class="truncate leading-none font-semibold text-base">{{ config('app.name') }}</span>
    </div> --}}
</div>

{{-- Mobile Logo --}}
<div class="flex items-center sm:hidden">
    <img 
        src="{{ asset('logos/no-bg-logo.png') }}" 
        alt="Logo" 
        class="w-16 h-16 mix-blend-multiply dark:mix-blend-normal dark:opacity-100 transition-all duration-200"
    >
</div>