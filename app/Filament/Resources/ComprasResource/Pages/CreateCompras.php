<?php

namespace App\Filament\Resources\ComprasResource\Pages;

use Filament\Actions;
use App\Models\Compras;
use App\Models\Inventarios;
use App\Models\Deta_Compras;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ComprasResource;

class CreateCompras extends CreateRecord
{
    protected static string $resource = ComprasResource::class;

    protected function afterCreate(): void
    {

        // Obtener el ID de la compra recién creada
        $compraId = $this->record->id;

        // Acceder a los datos del repeater (o de donde provengan los detalles)
        $detalles = $this->form->getState()['items']; // Ajusta esto según la estructura de tu formulario

        // Crear y guardar detalles de compra
        foreach ($detalles as $detalle) {
            Deta_Compras::create([
                'compras_id' => $compraId,
                'inventarios_id' => $detalle['inventarios_id'],
                'cantidad' => $detalle['cantidad'],
                'valor' => $detalle['valor'],
                'subtotal' => $detalle['subtotal'],
            ]);
        }
        Log::info('Detalles guardados correctamente.');


        // Obtener los detalles de la compra recién creada
        $detalles = $this->record->detallesCompras;

        // Recorrer cada detalle de la compra
        foreach ($detalles as $detalle) {
            // Obtener el inventario relacionado al detalle de la compra
            $inventario = $detalle->inventarios;

            // Aumentar la cantidad en el inventario
            $inventario->existencias += $detalle->cantidad; // Asumiendo que el campo en detalle es 'cantidad'

            // Guardar los cambios en el inventario
            $inventario->save();
        }
    }
}

