<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReporteFinanciero extends Model
{
    public function administrador() {
        return $this->belongsTo(Administrador::class);
        }
}
