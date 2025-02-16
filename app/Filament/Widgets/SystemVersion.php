<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SystemVersion extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('System Version', 'v.'.config('cw.version'))
                ->description( env('APP_NAME') ),
        ];
    }
}
