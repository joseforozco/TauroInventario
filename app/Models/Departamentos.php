<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function ciudades()
    {
        return $this->hasMany(Ciudades::class, 'departamentos_id');
    }

    public function clientes()
    {
        return $this->hasMany(Clientes::class, 'departamentos_id');
    }

    public function proveedores()
    {
        return $this->hasMany(Proveedores::class, 'departamentos_id');
    }

}
