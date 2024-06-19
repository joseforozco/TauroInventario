<?php

namespace App\Filament\Resources\MedidasResource\Pages;

use App\Filament\Resources\MedidasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMedidas extends ListRecords
{
    protected static string $resource = MedidasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
