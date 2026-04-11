<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalProducts = \App\Models\Product::count();
        $totalPosts = \App\Models\Post::count();
        $totalViews = \App\Models\Product::sum('views_count');

        // Kalkulasi Storage
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
        $sizeInMb = number_format($sizeInBytes / 1048576, 2) . ' MB';

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
            Stat::make('Penggunaan Storage', $sizeInMb)
                ->description('Ruang penyimpanan terpakai (' . storage_path('app/public') . ')')
                ->descriptionIcon('heroicon-m-server')
                ->color('gray'),
        ];
    }
}
