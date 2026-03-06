<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User; // <--- Opcional si usas la ruta completa abajo, pero es buena práctica

class ClienteFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Busca un usuario existente que esté en posiciiónd de registrar y toma su ID
            'user_id' => \App\Models\User::inRandomOrder()->first()->id, 
            'nombre' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telefono' => fake()->numerify('##########'),
        ];
    }
}