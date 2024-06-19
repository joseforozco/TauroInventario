<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $fillable = [
        'documento',
        'nombre',
        'direccion',
        'email',
        'telefono',
        'departamentos_id',
        'ciudades_id'
    ];

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = ucwords(strtolower($value));
    }

        public function setemailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    public function setdireccionAttribute($value)
    {
        $this->attributes['direccion'] = ucwords(strtolower($value));
    }

    public function departamentos()
    {
        return $this->belongsTo(Departamentos::class, 'departamentos_id');
    }

    public function ciudades()
    {
        return $this->belongsTo(Ciudades::class, 'ciudades_id');
    }

    public function ventas()
    {
        return $this->hasMany(Ventas::class, 'clientes_id');
    }

    public function cotizaciones()
    {
        return $this->hasMany(Cotizaciones::class, 'clientes_id');
    }

}
