<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre',
        'email',
        'telefono',
        'pais', // 👈 Agregado
        'notas_esteticas',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}