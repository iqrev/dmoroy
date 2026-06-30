<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ManualBook extends Page
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Manual Book';
    protected static ?string $title = 'Panduan Penggunaan (Manual Book)';
    protected static string | \UnitEnum | null $navigationGroup = 'Bantuan';
    protected static ?int $navigationSort = 100;

    protected string $view = 'filament.pages.manual-book';
}
