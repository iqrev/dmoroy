<?php

namespace App\Filament\Resources\CustomerGalleries\Pages;

use App\Filament\Resources\CustomerGalleries\CustomerGalleryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCustomerGalleries extends ListRecords
{
    protected static string $resource = CustomerGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
