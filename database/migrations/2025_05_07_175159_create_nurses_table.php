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
        Schema::create('nurses', function (Blueprint $table) {
            $table->id();

            // Relación con la tabla de órdenes
            $table->foreignId('order_id')->constrained('orders');
            $table->unique('order_id'); // Asumiendo que un reporte de enfermería pertenece a una única orden

            $table->string('h_cl')->nullable();
            $table->string('frecuencia_hd')->nullable();
            // Nº HD, ARTERIAL, VENOSO y Otros (Secuencia) YA NO SON COLUMNAS AQUÍ

            $table->string('puesto')->nullable();
            $table->string('aspecto_dializador')->nullable();
            $table->string('pa_inicial')->nullable();
            $table->string('pa_final')->nullable();
            $table->string('peso_inicial')->nullable();
            $table->string('peso_final')->nullable();
            $table->string('nro_maquina')->nullable();
            $table->string('marca_modelo')->nullable();
            $table->string('filtro')->nullable();
            $table->string('uif')->nullable();
            $table->string('hierro')->nullable()->default('0');
            $table->string('epo_2000')->nullable()->default('0');
            $table->string('epo_4000')->nullable()->default('0');
            $table->string('hidroxicobalamina')->nullable()->default('0');
            $table->string('calcitriol')->nullable()->default('0');
            $table->string('otros_medicamentos')->nullable();
            $table->text('s_')->nullable();
            $table->text('o_')->nullable();
            $table->text('a_')->nullable();
            $table->text('p_')->nullable();
            $table->text('observacion_final')->nullable();

            $table->foreignId('usuario_atencion')->nullable()->constrained('users');
            $table->foreignId('usuario_finaliza_hd')->nullable()->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nurses');
    }
};
