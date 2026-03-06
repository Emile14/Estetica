<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; // <--- 1. Agrega esta línea arriba
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;

    public function usuario() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reportes() {
        return $this->hasMany(ReporteFinanciero::class);
        }
}
