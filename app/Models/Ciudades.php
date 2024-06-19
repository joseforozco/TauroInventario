<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudades extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'departamentos_id'];

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = ucwords(strtolower($value));
    }

    public function departamentos()
    {
        return $this->belongsTo(Departamentos::class, 'departamentos_id');
    }

    public function clientes()
    {
        return $this->hasMany(Clientes::class, 'ciudades_id');
    }

    public function proveedores()
    {
        return $this->hasMany(Proveedores::class, 'ciudades_id');
    }

}
