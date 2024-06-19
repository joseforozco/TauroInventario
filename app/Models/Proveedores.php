<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    use HasFactory;

    protected $fillable = [
        'documento',
        'nombre',
        'direccion',
        'email',
        'telefono',
        'departamentos_id',
        'ciudades_id',
        'users_id'
    ];

    public function departamentos()
    {
        return $this->belongsTo(Departamentos::class, 'departamentos_id');
    }

    public function ciudades()
    {
        return $this->belongsTo(Ciudades::class, 'ciudades_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function inventarios()
    {
        return $this->hasMany(Inventarios::class, 'proveedores_id');
    }

    public function compras()
    {
        return $this->hasMany(Compras::class, 'proveedores_id');
    }


}
