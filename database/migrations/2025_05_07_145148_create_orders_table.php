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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_id')->constrained('patients'); // Clave foránea a la tabla pacientes
            $table->string('sala'); // Ejemplo: MODULO 1
            $table->string('turno'); // Ejemplo: TURNO 1
            $table->boolean('covid')->nullable(); // ¿COVID? (true/false o nullable)
            $table->string('hd'); // HD: (Ejemplo: 3!)
            $table->string('fua'); // FUA (se generará)
            $table->date('fecha_creacion'); // FECHA DE CREACION
            $table->enum('tipo_procedimiento', ['HD', 'CONSULTA'])->default('HD'); // TIPO PROCEDIMIENTO: HEMODIALISIS
            $table->enum('incluye_laboratorio', ['M','B','T','S'])->nullable(); // ¿INCLUYE LABORATORIO? (true/false o nullable)
            $table->integer('numero_sesion')->nullable(); // Numero de sesión del paciente (se gestionará)
            $table->time('hora_inicial')->nullable(); // Hora inicial (formato HH:MM:SS)
            $table->string('peso_inicial')->nullable(); // Peso inicial (puede ser string para permitir decimales)
            $table->string('peso_final')->nullable(); // Peso final (puede ser string para permitir decimales)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
