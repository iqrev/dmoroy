<?php

namespace App\Filament\Resources\CustomerGalleries\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class CustomerGalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Section::make()
                    ->schema([
                        \Awcodes\Curator\Components\Forms\CuratorPicker::make('media_id')
                            ->label('Gambar / Foto Pelanggan')
                            ->directory('galleries')
                            ->required(),
                        Forms\Components\TextInput::make('instagram_url')
                            ->label('Link Instagram (Opsional)')
                            ->url(),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif (Tampilkan)')
                            ->default(true),
                    ])
            ]);
    }
}
