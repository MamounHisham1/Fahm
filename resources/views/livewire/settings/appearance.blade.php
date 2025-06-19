<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Appearance')" :subheading=" __('Update the appearance settings for your account')">
        {{-- Dark mode temporarily disabled --}}
        {{-- <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
            <flux:radio value="light" icon="sun">{{ __('Light') }}</flux:radio>
            <flux:radio value="dark" icon="moon">{{ __('Dark') }}</flux:radio>
            <flux:radio value="system" icon="computer-desktop">{{ __('System') }}</flux:radio>
        </flux:radio.group> --}}
        
        <div class="text-center py-8">
            <p class="text-gray-600">Dark mode is currently disabled. Light mode is active by default.</p>
        </div>
    </x-settings.layout>
</section>
