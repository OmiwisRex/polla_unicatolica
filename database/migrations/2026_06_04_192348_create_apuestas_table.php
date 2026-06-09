<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('apuestas', function (Blueprint $table) {
            $table->id();

            // Claves foráneas que componen la apuesta
            $table->foreignId('usuario_id')->constrained('usuarios')->onUpdate('cascade');

            $table->foreignId('partido_id')->constrained('partidos')->onUpdate('cascade');

            $table->foreignId('pregunta_id')->constrained('preguntas')->onUpdate('cascade');

            // Predicciones del usuario (todas opcionales/configurables)
            $table->tinyInteger('goles_a')->nullable();
            $table->tinyInteger('goles_b')->nullable();
            $table->tinyInteger('ganador')->nullable();
            $table->tinyInteger('pts_pregunta')->nullable();
            $table->tinyInteger('pts_apuesta')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('apuestas');
    }
};