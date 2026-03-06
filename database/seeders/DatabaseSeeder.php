<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Sembrar los datos fijos (Seeders)
        $this->call([
            UserSeeder::class,
            ServicioSeeder::class,
        ]);

        // 2. Sembrar los datos masivos (Factories)
        \App\Models\Administrador::factory(5)->create();
        \App\Models\Cliente::factory(50)->create();
    }
}