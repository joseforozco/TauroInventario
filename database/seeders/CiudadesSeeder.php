<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CiudadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ciudades')->insert([
            ['id' => 1, 'nombre' => 'Medellín', 'departamentos_id' => 5],
            ['id' => 2, 'nombre' => 'Barranquilla', 'departamentos_id' => 8],
            ['id' => 3, 'nombre' => 'Bogotá', 'departamentos_id' => 11],
            ['id' => 4, 'nombre' => 'Cartagena', 'departamentos_id' => 13],
            ['id' => 5, 'nombre' => 'Tunja', 'departamentos_id' => 15],
            ['id' => 6, 'nombre' => 'Manizales', 'departamentos_id' => 17],
            ['id' => 7, 'nombre' => 'Florencia', 'departamentos_id' => 18],
            ['id' => 8, 'nombre' => 'Popayán', 'departamentos_id' => 19],
            ['id' => 9, 'nombre' => 'Valledupar', 'departamentos_id' => 20],
            ['id' => 10, 'nombre' => 'Montería', 'departamentos_id' => 23],
            ['id' => 11, 'nombre' => 'Quibdó', 'departamentos_id' => 27],
            ['id' => 12, 'nombre' => 'Neiva', 'departamentos_id' => 41],
            ['id' => 13, 'nombre' => 'Riohacha', 'departamentos_id' => 44],
            ['id' => 14, 'nombre' => 'Santa Marta', 'departamentos_id' => 47],
            ['id' => 15, 'nombre' => 'Villavicencio', 'departamentos_id' => 50],
            ['id' => 16, 'nombre' => 'Pasto', 'departamentos_id' => 52],
            ['id' => 17, 'nombre' => 'Cúcuta', 'departamentos_id' => 54],
            ['id' => 18, 'nombre' => 'Armenia', 'departamentos_id' => 63],
            ['id' => 19, 'nombre' => 'Pereira', 'departamentos_id' => 66],
            ['id' => 20, 'nombre' => 'Bucaramanga', 'departamentos_id' => 68],
            ['id' => 21, 'nombre' => 'Sincelejo', 'departamentos_id' => 70],
            ['id' => 22, 'nombre' => 'Ibagué', 'departamentos_id' => 73],
            ['id' => 23, 'nombre' => 'Cali', 'departamentos_id' => 76],
            ['id' => 24, 'nombre' => 'Arauca', 'departamentos_id' => 81],
            ['id' => 25, 'nombre' => 'Yopal', 'departamentos_id' => 85],
            ['id' => 26, 'nombre' => 'Mocoa', 'departamentos_id' => 86],
            ['id' => 27, 'nombre' => 'San Andrés', 'departamentos_id' => 88],
            ['id' => 28, 'nombre' => 'Leticia', 'departamentos_id' => 91],
            ['id' => 29, 'nombre' => 'Inírida', 'departamentos_id' => 94],
            ['id' => 30, 'nombre' => 'San José del Guaviare', 'departamentos_id' => 95],
            ['id' => 31, 'nombre' => 'Mitú', 'departamentos_id' => 97],
            ['id' => 32, 'nombre' => 'Puerto Carreño', 'departamentos_id' => 99],
        ]);

    }
}
