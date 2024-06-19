<?php

namespace App\Filament\Resources\BodegasResource\Pages;

use App\Filament\Resources\BodegasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBodegas extends EditRecord
{
    protected static string $resource = BodegasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
