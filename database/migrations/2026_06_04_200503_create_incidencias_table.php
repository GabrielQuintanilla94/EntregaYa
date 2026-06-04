<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            
            // Relación con el conductor que reporta
            $table->foreignId('conductor_id')->constrained('users')->onDelete('cascade');
            
            // Relación con el paquete (opcional, porque la incidencia puede ser del vehículo)
            $table->foreignId('entrega_id')->nullable()->constrained('entregas')->onDelete('cascade');
            
            $table->string('tipo_incidencia'); // Ej: Accidente, Tráfico, Cliente ausente, Falla mecánica
            $table->text('detalles');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incidencias');
    }
};