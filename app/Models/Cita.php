<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    public function cliente() {
    return $this->belongsTo(Cliente::class); // Una cita pertenece a un cliente 
}

public function servicios() {
    return $this->belongsToMany(Servicior::class, 'detalle_citas'); // Una cita tiene muchos servicios 
}
}
