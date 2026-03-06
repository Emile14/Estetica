<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    public function citas(){
         return $this->hasMany(Cita::class); // Un cliente tiene muchas citas
    }
}
