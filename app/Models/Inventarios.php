<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventarios extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'codigo',
        'barra',
        'medidas_id',
        'existencias',
        'valor',
        'total',
        'minimo',
        'categorias_id',
        'marcas_id',
        'bodegas_id',
        'proveedores_id',
    ];

    public function medidas()
    {
        return $this->belongsTo(medidas::class, 'medidas_id');
    }


    public function categorias()
    {
        return $this->belongsTo(Categorias::class, 'categorias_id');
    }

    public function marcas()
    {
        return $this->belongsTo(Marcas::class, 'marcas_id');
    }

    public function bodegas()
    {
        return $this->belongsTo(Bodegas::class, 'bodegas_id');
    }

    public function proveedores()
    {
        return $this->belongsTo(Proveedores::class, 'proveedores_id');
    }

    public function detallesCompras()
    {
        return $this->hasMany(Deta_Compras::class, 'inventarios_id');
    }

    public function detallesVentas()
    {
        return $this->hasMany(Deta_Ventas::class, 'inventarios_id');
    }

    public function detallesCotizaciones()
    {
        return $this->hasMany(Deta_Cotizaciones::class, 'inventarios_id');
    }

}
