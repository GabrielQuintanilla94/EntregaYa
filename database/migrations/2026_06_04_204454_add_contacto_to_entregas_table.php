<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('entregas', function (Blueprint $table) {
            $table->string('nombre_contacto')->nullable()->after('direccion');
            $table->string('celular_contacto')->nullable()->after('nombre_contacto');
        });
    }

    public function down(): void
    {
        Schema::table('entregas', function (Blueprint $table) {
            $table->dropColumn(['nombre_contacto', 'celular_contacto']);
        });
    }
};