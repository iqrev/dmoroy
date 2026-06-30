<?php

namespace App\Filament\Resources\CustomerGalleries\Pages;

use App\Filament\Resources\CustomerGalleries\CustomerGalleryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCustomerGallery extends EditRecord
{
    protected static string $resource = CustomerGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
