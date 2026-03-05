<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    public function usuario() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reportes() {
        return $this->hasMany(ReporteFinanciero::class);
        }
}
