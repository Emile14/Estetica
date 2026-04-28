<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reporte_financieros', function (Blueprint $table) {
            $table->id();
            $table->date('fecha'); // Para saber qué día fue la venta
            $table->string('concepto'); // Ej. "Corte de cabello"
            $table->string('atendido_por'); // Ej. "Blanca"
            $table->decimal('monto', 8, 2); // Para guardar dinero con 2 decimales
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reporte_financieros');
    }
};