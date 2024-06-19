<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deta_Ventas extends Model
{
    use HasFactory;

    protected $fillable = [
        'ventas_id',
        'inventarios_id',
        'cantidad',
        'valor',
        'subtotal'
    ];

    public function ventas()
    {
        return $this->belongsTo(Ventas::class, 'ventas_id');
    }

    public function inventarios()
    {
        return $this->belongsTo(Inventarios::class, 'inventarios_id');
    }

}
