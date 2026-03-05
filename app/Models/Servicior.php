<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicior extends Model
{
    public function citas() {
    return $this->belongsToMany(Cita::class, 'detalle_citas');
}
}
