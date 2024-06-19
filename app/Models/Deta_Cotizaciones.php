<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deta_Cotizaciones extends Model
{
    use HasFactory;

    protected $fillable = [
        'cotizaciones_id',
        'inventarios_id',
        'cantidad',
        'valor',
        'subtotal'
    ];

    public function cotizaciones()
    {
        return $this->belongsTo(Cotizaciones::class, 'cotizaciones_id');
    }

    public function inventarios()
    {
        return $this->belongsTo(Inventarios::class, 'inventarios_id');
    }

}
