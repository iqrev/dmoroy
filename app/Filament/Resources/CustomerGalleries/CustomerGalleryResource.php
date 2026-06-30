<?php

namespace App\Filament\Resources\CustomerGalleries;

use App\Filament\Resources\CustomerGalleries\Pages\CreateCustomerGallery;
use App\Filament\Resources\CustomerGalleries\Pages\EditCustomerGallery;
use App\Filament\Resources\CustomerGalleries\Pages\ListCustomerGalleries;
use App\Filament\Resources\CustomerGalleries\Schemas\CustomerGalleryForm;
use App\Filament\Resources\CustomerGalleries\Tables\CustomerGalleriesTable;
use App\Models\CustomerGallery;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CustomerGalleryResource extends Resource
{
    protected static ?string $model = CustomerGallery::class;

    protected static ?string $modelLabel = 'Galeri Pelanggan';
    protected static ?string $pluralModelLabel = 'Galeri Pelanggan';
    protected static string|\UnitEnum|null $navigationGroup = 'Tampilan Depan';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return CustomerGalleryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CustomerGalleriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCustomerGalleries::route('/'),
            'create' => CreateCustomerGallery::route('/create'),
            'edit' => EditCustomerGallery::route('/{record}/edit'),
        ];
    }
}
