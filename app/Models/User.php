<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol',
        'telefono',
        'pais', // Asegúrate de tener este campo si usas la API de países
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Mapeo para que Laravel encuentre los campos aunque estén en español
    public function getNameAttribute() { return $this->nombre; }
    public function getRoleAttribute() { return $this->rol; }

    // 👇 AQUÍ ESTÁ LA MAGIA: Le enseñamos a Laravel a buscar al cliente vinculado
    public function cliente()
    {
        return $this->hasOne(Cliente::class);
    }
}