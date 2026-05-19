<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalProducts = \App\Models\Product::count();
        $totalPosts = \App\Models\Post::count();
        $totalViews = \App\Models\Product::sum('views_count');

        // Kalkulasi Storage (Max 15GB)
        $maxStorageBytes = 15 * 1024 * 1024 * 1024;
        $path = storage_path('app/public');
        $sizeInBytes = 0;
        if (is_dir($path)) {
            $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
            foreach ($iterator as $file) {
                if ($file->isFile()) {
                    $sizeInBytes += $file->getSize();
                }
            }
        }
        
        $sizeInMb = round($sizeInBytes / 1048576, 2);
        $percentUsed = round(($sizeInBytes / $maxStorageBytes) * 100, 1);
        
        // Data grafik (faked to show usage level)
        $chartData = [0, $percentUsed / 2, $percentUsed, $percentUsed, $percentUsed * 1.1, $percentUsed];
        $color = $percentUsed > 80 ? 'danger' : ($percentUsed > 50 ? 'warning' : 'success');

        return [
            Stat::make('Total Produk', $totalProducts)
                ->description('Produk terdaftar di katalog')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('success'),
            Stat::make('Total Artikel', $totalPosts)
                ->description('Artikel dan wawasan diterbitkan')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info'),
            Stat::make('Total Kunjungan Produk', $totalViews)
                ->description('Total klik detail produk')
                ->descriptionIcon('heroicon-m-eye')
                ->color('warning'),
            Stat::make('Kapasitas Hosting', $sizeInMb . ' MB / 15 GB')
                ->description($percentUsed . '% telah digunakan')
                ->descriptionIcon('heroicon-m-server')
                ->chart($chartData)
                ->color($color),
        ];
    }
}
