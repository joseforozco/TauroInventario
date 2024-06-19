<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deta_Compras extends Model
{
    use HasFactory;

    protected $fillable = [
        'compras_id',
        'inventarios_id',
        'cantidad',
        'valor',
        'subtotal'
    ];

    public function compras()
    {
        return $this->belongsTo(compras::class, 'compras_id');
    }

    public function inventarios()
    {
        return $this->belongsTo(Inventarios::class, 'inventarios_id');
    }

}
