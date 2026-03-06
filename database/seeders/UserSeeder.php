<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nombre' => 'Pedro Sánchez',
                'rol' => 'Administrador',
                'email' => 'pedro.sanchez@miProyecto.com',
                'password' => Hash::make('p3Dr054nchez'),
                'telefono' => '3312345678', // Requerido por la migración
            ],
            [
                'nombre' => 'Ana López',
                'rol' => 'Estilista',
                'email' => 'ana.lopez@miProyecto.com',
                'password' => Hash::make('estilista123'),
                'telefono' => '3312345679',
            ],
            [
                'nombre' => 'Carlos Ruiz',
                'rol' => 'Recepcionista',
                'email' => 'carlos.ruiz@miProyecto.com',
                'password' => Hash::make('recepcion123'),
                'telefono' => '3312345680',
            ]
        ]);
    }
}