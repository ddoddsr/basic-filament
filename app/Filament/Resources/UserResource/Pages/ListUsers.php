<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [
            'all' => Tab::make('All')
                ->badge($this->getModel()::count()),
            
            'staff' => Tab::make('Staff')
                ->modifyQueryUsing(fn ($query) => $query->where('user_type', 'STAFF'))
                ->badge($this->getModel()::where('user_type', 'STAFF')->count()),
            
            'client' => Tab::make('Client')
                ->modifyQueryUsing(fn ($query) => $query->where('user_type', 'CLIENT'))
                ->badge($this->getModel()::where('user_type', 'CLIENT')->count()),
        ];

        return $tabs;
    }
}
