<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clientes')->insert([
            ['id' => 1,
            'documento' => '999999999',
            'nombre' => 'CLIENTES VARIOS',
            'direccion' => 'SIN INFORMACION',
            'email' => 'no_tiene_correo@correo.com',
            'telefono' => '9999999999',
            'departamentos_id' => 54,
            'ciudades_id' => 17]
        ]);
    }
}
