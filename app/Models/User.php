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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Mapeo para que Laravel encuentre los campos aunque estén en español
    public function getNameAttribute() { return $this->nombre; }
    public function getRoleAttribute() { return $this->rol; }
}