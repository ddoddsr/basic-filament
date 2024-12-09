<?php

namespace App\Filament\Resources\UserTestResource\Pages;

use App\Filament\Resources\UserTestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserTests extends ListRecords
{
    protected static string $resource = UserTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
