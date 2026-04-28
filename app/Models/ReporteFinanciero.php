<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReporteFinanciero extends Model
{
    use HasFactory;

    protected $fillable = ['fecha', 'concepto', 'atendido_por', 'monto'];
}