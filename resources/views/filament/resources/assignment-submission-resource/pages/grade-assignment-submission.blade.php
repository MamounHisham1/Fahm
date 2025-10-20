<x-filament-panels::page>
    <x-filament-panels::form wire:submit="saveGrade">
        {{ $this->form }}

        <div class="flex justify-end gap-4 pt-6">
            <x-filament::button
                type="button"
                color="gray"
                wire:click="$dispatch('close-modal', { id: 'grade-assignment' })"
                tag="a"
                :href="\App\Filament\Resources\AssignmentSubmissionResource::getUrl('index')"
            >
                Cancel
            </x-filament::button>

            <x-filament::button type="submit">
                Save Grade
            </x-filament::button>
        </div>
    </x-filament-panels::form>
</x-filament-panels::page>