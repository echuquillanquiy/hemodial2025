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
        Schema::create('medicals', function (Blueprint $table) {
            $table->id();

            // Relación con la tabla de órdenes
            $table->foreignId('order_id')->constrained('orders');
            $table->unique('order_id'); // Asumiendo que un reporte pertenece a una única orden

            $table->time('hora_inicial')->nullable();
            $table->string('peso_inicial')->nullable();
            $table->string('pa_inicial')->nullable();
            $table->string('frecuencia_cardiaca')->nullable();
            $table->string('saturacion_so2')->nullable();
            $table->decimal('fio2')->nullable();
            $table->string('temperatura')->nullable();
            $table->text('problemas_clinicos')->nullable();
            $table->text('evaluacion')->nullable();
            $table->text('indicaciones')->nullable();
            $table->text('signos_sintomas')->nullable();
            $table->integer('epoetina_alfa_2000')->nullable()->default(0);
            $table->integer('epoetina_alfa_4000')->nullable()->default(0);
            $table->string('hierro')->nullable()->default(0);
            $table->string('hidroxicobalamina')->nullable()->default(0);
            $table->string('calcitriol')->nullable()->default(0);
            $table->time('hora_hd')->nullable();
            $table->string('heparina')->nullable();
            $table->string('peso_seco')->nullable();
            $table->string('uf')->nullable();
            $table->string('qb')->nullable();
            $table->string('qd')->nullable();
            $table->string('bicarbonato')->nullable();
            $table->string('na_inicial')->nullable();
            $table->string('cnd')->nullable();
            $table->string('na_final')->nullable();
            $table->string('perfil_na')->nullable();
            $table->string('area_filtro')->nullable();
            $table->string('membrana')->nullable();
            $table->string('perfil_uf')->nullable();
            $table->text('evaluacion_final')->nullable();
            $table->time('hora_final')->nullable();

            // Relaciones con la tabla de usuarios
            $table->foreignId('usuario_inicio_hd')->nullable()->constrained('users');
            $table->foreignId('usuario_finaliza_hd')->nullable()->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicals');
    }
};
