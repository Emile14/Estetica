<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    // Permitir guardar estos datos desde el formulario
    protected $fillable = [
        'cliente_id',
        'servicio',
        'fecha',
        'hora',
        'estado'
    ];

    // Relación: Una cita pertenece a un cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}