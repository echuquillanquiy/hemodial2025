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
        Schema::create('fuas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_empresa', 8); // Código de empresa (siempre el mismo)
            $table->string('anio', 2); // Año de 2 dígitos
            $table->string('numero_fua', 8); // Número de FUA de 8 dígitos (requerido)
            $table->string('serie_completa')->virtualAs("CONCAT(codigo_empresa, '-', anio, '-', LPAD(numero_fua, 8, '0'))")->index();

            // Índice único para asegurar que no haya duplicados de numero_fua para el mismo año y código de empresa
            $table->unique(['codigo_empresa', 'anio', 'numero_fua']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuas');
    }
};
