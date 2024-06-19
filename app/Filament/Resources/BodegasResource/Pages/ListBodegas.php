<?php

namespace App\Filament\Resources\BodegasResource\Pages;

use App\Filament\Resources\BodegasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBodegas extends ListRecords
{
    protected static string $resource = BodegasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
