<x-filament-panels::page>
    <x-filament-schemas::form wire:submit="export">
        {{ $this->form }}

        <div class="flex flex-wrap items-center gap-4 py-4">
            <x-filament::button type="submit" size="sm">
                Unduh CSV
            </x-filament::button>
        </div>
    </x-filament-schemas::form>
</x-filament-panels::page>
