<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up(): void
    {
        Schema::create('entregas', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion'); // Ejemplo: "Caja de zapatos"
            $table->string('direccion'); // Ejemplo: "Calle San Salvador #123"
            
            // Relación con el conductor (Apunta a la tabla users)
            $table->foreignId('conductor_id')->constrained('users')->onDelete('cascade');
            
            // Relación con el vehículo (Apunta a la tabla vehiculos)
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->onDelete('cascade');
            
            // Estado del paquete
            // Estado del paquete actualizado
            $table->enum('estado', ['Pendiente', 'En camino', 'Entregado', 'Reportado'])->default('Pendiente');

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entregas');
    }
};
