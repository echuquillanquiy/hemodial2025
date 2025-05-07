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
        Schema::create('laboratories', function (Blueprint $table) {
            $table->id();

            $table->string('descripcion');
            $table->string('codigo')->nullable();
            $table->integer('cantidad')->nullable();
            $table->enum('tipo_examen', ['MENSUAL', 'BIMENSUAL', 'TRIMESTRAL', 'SEMESTRAL']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratories');
    }
};
