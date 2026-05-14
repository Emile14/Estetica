<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservaProducto extends Model
{
    protected $fillable = ['cliente_id', 'producto_id', 'cita_id', 'cantidad', 'estado'];

    public function cliente() { return $this->belongsTo(Cliente::class); }
    public function producto() { return $this->belongsTo(Producto::class); }
    public function cita() { return $this->belongsTo(Cita::class); }
}