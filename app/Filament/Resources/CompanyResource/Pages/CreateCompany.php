<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCompany extends CreateRecord
{
    protected static string $resource = CompanyResource::class;

    // redirect to list after creating
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
