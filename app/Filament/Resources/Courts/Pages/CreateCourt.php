<?php

namespace App\Filament\Resources\Courts\Pages;

use App\Filament\Resources\Courts\CourtResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCourt extends CreateRecord
{
    protected static string $resource = CourtResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
