<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class MaintenanceWidget extends Widget
{
    protected static ?int $sort = -1;

    protected string $view = 'filament.widgets.maintenance-widget';

    protected int | string | array $columnSpan = 'full';

    public bool $isDown = false;

    public function mount(): void
    {
        $this->isDown = app()->isDownForMaintenance();
    }

    public function toggleMaintenance(): void
    {
        if ($this->isDown) {
            \Illuminate\Support\Facades\Artisan::call('up');
            \Filament\Notifications\Notification::make()
                ->title('Website Aktif')
                ->body('Website kini telah keluar dari mode maintenance dan bisa diakses oleh publik.')
                ->success()
                ->send();
        } else {
            \Illuminate\Support\Facades\Artisan::call('down');
            \Filament\Notifications\Notification::make()
                ->title('Mode Maintenance Aktif')
                ->body('Website kini offline untuk publik. Hanya halaman admin yang bisa diakses.')
                ->warning()
                ->send();
        }

        $this->isDown = app()->isDownForMaintenance();
    }
}
