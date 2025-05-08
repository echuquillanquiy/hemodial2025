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
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();

            // Relación con la tabla de órdenes
            $table->foreignId('order_id')->constrained('orders');
            $table->unique('order_id');

            $table->string('hr')->nullable(); // HR (Hora)
            $table->string('pa')->nullable(); // PA (Presión Arterial)
            $table->string('fc')->nullable(); // FC (Frecuencia Cardiaca)
            $table->string('qb')->nullable(); // QB (Flujo Sanguíneo)
            $table->string('cnd')->nullable(); // CND (Conductividad)
            $table->string('ra')->nullable(); // RA (¿Resistencia Arterial?) - Por favor, aclara si tienes el nombre completo
            $table->string('rv')->nullable(); // RV (¿Resistencia Venosa?) - Por favor, aclara si tienes el nombre completo
            $table->string('ptm')->nullable(); // PTM (Presión Transmembrana)
            $table->string('sol_hemoderivados')->nullable(); // SOL/HEMODERIVADOS (Soluciones/Hemoderivados administrados)
            $table->text('observacion')->nullable(); // Observación

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};
