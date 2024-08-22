<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bodegas extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','direccion','ciudades_id','departamentos_id'];

    public function inventarios()
    {
        return $this->hasMany(Inventarios::class, 'bodegas_id');
    }

    public function departamentos()
    {
        return $this->belongsTo(Departamentos::class, 'departamentos_id');
    }

    public function ciudades()
    {
        return $this->belongsTo(Ciudades::class, 'ciudades_id');
    }

}
