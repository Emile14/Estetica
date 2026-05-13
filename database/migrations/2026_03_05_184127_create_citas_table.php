<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            
            // Agregamos las columnas que necesita nuestro formulario
            $table->string('servicio');
            $table->date('fecha');
            $table->time('hora');
            $table->string('estado')->default('Pendiente');
            
            // Esto es crucial para que no falle el updated_at y created_at
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};