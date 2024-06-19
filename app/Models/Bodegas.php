<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bodegas extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function inventarios()
    {
        return $this->hasMany(Inventarios::class, 'bodegas_id');
    }

}
