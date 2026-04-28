<x-filament-panels::page>
    <form wire:submit="export">
        {{ $this->form }}

        <div class="flex flex-wrap items-center gap-4 py-4">
            <x-filament::button type="submit" size="sm">
                Unduh CSV
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
