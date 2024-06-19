<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizaciones extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'clientes_id',
        'numerofactura',
        'valorfactura',
        'ivafactura',
        'totalfactura'
    ];

    public function clientes()
    {
        return $this->belongsTo(Clientes::class, 'clientes_id');
    }

    public function detallesCotizaciones()
    {
        return $this->hasMany(Deta_Cotizaciones::class, 'cotizaciones_id');
    }

}
