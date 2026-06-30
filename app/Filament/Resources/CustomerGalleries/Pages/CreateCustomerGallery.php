<?php

namespace App\Filament\Resources\CustomerGalleries\Pages;

use App\Filament\Resources\CustomerGalleries\CustomerGalleryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomerGallery extends CreateRecord
{
    protected static string $resource = CustomerGalleryResource::class;
}
