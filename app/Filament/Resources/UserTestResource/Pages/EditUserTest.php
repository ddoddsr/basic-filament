<?php

namespace App\Filament\Resources\UserTestResource\Pages;

use App\Filament\Resources\UserTestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserTest extends EditRecord
{
    protected static string $resource = UserTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
