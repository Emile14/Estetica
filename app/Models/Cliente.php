<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    /**
     * Atributos que se pueden asignar masivamente.
     * Deben coincidir exactamente con las columnas de tu phpMyAdmin.
     */
    protected $fillable = [
        'user_id',
        'nombre',
        'email',
        'telefono',
    ];

    /**
     * Relación: Un cliente pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Un cliente tiene muchas citas.
     */
    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}