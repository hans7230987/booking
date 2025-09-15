<?php

namespace App\Filament\Resources\Venues\Pages;

use App\Filament\Resources\Venues\VenueResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVenue extends CreateRecord
{
    protected static string $resource = VenueResource::class;
    
    protected function getRedirectUrl(): string
    {
        // 新增成功後，回到列表頁
        return $this->getResource()::getUrl('index');
    }
}
