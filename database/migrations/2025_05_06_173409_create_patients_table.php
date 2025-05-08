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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('primer_nombre');
            $table->string('otros_nombres')->nullable();
            $table->string('primer_apellido')->nullable();
            $table->string('segundo_apellido')->nullable();
            $table->string('dni')->unique();
            $table->string('secuencia');
            $table->string('turno');
            $table->string('modulo')->nullable();
            $table->string('peso_seco')->nullable();
            $table->string('acceso_arterial');
            $table->string('acceso_venoso');
            $table->string('estado')->default('activo');
            $table->string('codigo_cs')->unique();
            $table->string('n_hd')->unique();
            $table->string('n_historia')->nullable();
            $table->text('justificacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
