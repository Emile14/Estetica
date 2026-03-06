<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('serviciors')->insert([
            [
                'nombre' => 'Corte de Cabello', 
                'descripcion' => 'Corte estilo clásico o moderno', 
                'precio' => 250.00, 
                'duracion' => 30
            ],
            [
                'nombre' => 'Tinte y Luces', 
                'descripcion' => 'Coloración completa y lavado', 
                'precio' => 1200.00, 
                'duracion' => 120
            ],
            [
                'nombre' => 'Manicura Spa', 
                'descripcion' => 'Limpieza, exfoliación y esmaltado', 
                'precio' => 350.00, 
                'duracion' => 45
            ],
        ]);
    }
}