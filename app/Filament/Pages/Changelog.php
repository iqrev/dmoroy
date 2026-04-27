<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Changelog extends Page
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static string | \UnitEnum | null $navigationGroup = 'Pengaturan';
    protected static ?int $navigationSort = 10;
    protected static ?string $title = 'Changelog';

    protected string $view = 'filament.pages.changelog';

    public $content = '';

    public function mount()
    {
        $changelogPath = base_path('CHANGELOG.md');

        if (File::exists($changelogPath)) {
            $markdown = File::get($changelogPath);
            $this->content = Str::markdown($markdown);
        } else {
            $this->content = '<p>Berkas CHANGELOG.md tidak ditemukan.</p>';
        }
    }
}
