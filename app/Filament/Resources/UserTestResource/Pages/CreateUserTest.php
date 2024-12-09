<?php

namespace App\Filament\Resources\UserTestResource\Pages;

use App\Filament\Resources\UserTestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUserTest extends CreateRecord
{
    protected static string $resource = UserTestResource::class;
}
