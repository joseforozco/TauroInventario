<?php

namespace App\Filament\Resources\MedidasResource\Pages;

use App\Filament\Resources\MedidasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMedidas extends EditRecord
{
    protected static string $resource = MedidasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
