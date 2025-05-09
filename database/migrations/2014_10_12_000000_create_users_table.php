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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombres_apellidos')->nullable();
            $table->string('dni')->nullable()->unique();
            $table->string('username');
            $table->string('colegiatura')->nullable()->unique();
            $table->string('rne')->nullable()->unique();
            $table->string('profile')->nullable();
            $table->enum('modulo', ['MODULO 1', 'MODULO 2', 'MODULO 3', 'MODULO 4', 'TODOS'])->nullable(); // Define los valores de tu ENUM para 'modulo'
            $table->enum('rol', ['Administrador del Sistema', 'Medico', 'Licenciado', 'Adminitrativo', 'Auditor', 'Tecnico']); // Define los valores de tu ENUM para 'rol' con un valor por defecto
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
