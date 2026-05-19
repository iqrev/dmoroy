<x-filament-widgets::widget>
    <x-filament::section class="{{ $isDown ? 'ring-2 ring-danger-500' : 'border-l-4 border-l-success-500' }}">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h3 class="text-lg font-bold flex items-center gap-2 {{ $isDown ? 'text-danger-600' : 'text-gray-900 dark:text-white' }}">
                    <x-filament::icon
                        icon="{{ $isDown ? 'heroicon-s-exclamation-triangle' : 'heroicon-s-globe-asia-australia' }}"
                        class="h-6 w-6 {{ $isDown ? 'text-danger-600 animate-pulse' : 'text-success-500' }}"
                    />
                    Status Website: {{ $isDown ? 'Offline (Maintenance)' : 'Online (Aktif)' }}
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 ">
                    {{ $isDown ? 'Website saat ini ditutup untuk pengunjung publik. Namun Anda tetap bisa mengelola konten di halaman admin ini.' : 'Website sedang beroperasi normal dan bisa diakses oleh seluruh pengunjung publik.' }}
                </p>
            </div>
            
            <div class="shrink-0">
                <x-filament::button 
                    wire:click="toggleMaintenance" 
                    color="{{ $isDown ? 'success' : 'danger' }}"
                    icon="{{ $isDown ? 'heroicon-o-check-circle' : 'heroicon-o-power' }}"
                    size="lg"
                >
                    {{ $isDown ? 'Nyalakan Website' : 'Matikan Website (Maintenance)' }}
                </x-filament::button>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
