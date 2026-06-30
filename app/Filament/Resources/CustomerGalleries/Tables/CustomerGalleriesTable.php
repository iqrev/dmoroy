<?php

namespace App\Filament\Resources\CustomerGalleries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;

class CustomerGalleriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Awcodes\Curator\Components\Tables\CuratorColumn::make('media_id')
                    ->label('Gambar')
                    ->size(60),
                Tables\Columns\TextColumn::make('instagram_url')
                    ->label('Link IG')
                    ->limit(30),
                Tables\Columns\TextInputColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
