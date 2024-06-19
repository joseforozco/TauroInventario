<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'proveedores_id',
        'numerofactura',
        'valorfactura',
        'ivafactura',
        'totalfactura'
    ];

    public function proveedores()
    {
        return $this->belongsTo(Proveedores::class, 'proveedores_id');
    }

    public function detallesCompras()
    {
        return $this->hasMany(Deta_Compras::class, 'compras_id');
    }

}
