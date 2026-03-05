<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function citas(){
         return $this->hasMany(Cita::class); // Un cliente tiene muchas citas
    }
}
