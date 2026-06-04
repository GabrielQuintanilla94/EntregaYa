<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ejecuta una sentencia directa para modificar la columna enum en MySQL
        DB::statement("ALTER TABLE entregas MODIFY COLUMN estado ENUM('Pendiente', 'En camino', 'Entregado', 'Reportado') DEFAULT 'Pendiente'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE entregas MODIFY COLUMN estado ENUM('Pendiente', 'En camino', 'Entregado') DEFAULT 'Pendiente'");
    }
};