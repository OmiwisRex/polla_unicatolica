<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partidos', function (Blueprint $table) {
            $table->id();
            
            // Relación obligatoria con etapas
            $table->foreignId('etapa_id')->constrained('etapas')->onUpdate('cascade');

            // Los equipos pueden ser NULL al principio (fases eliminatorias)
            $table->foreignId('equipo_a_id')->nullable()->constrained('equipos')->onUpdate('cascade');

            $table->foreignId('equipo_b_id')->nullable()->constrained('equipos')->onUpdate('cascade');

            // Usamos timestamp para registrar fecha y hora con zonas horarias
            $table->timestamp('fecha_hora')->nullable();
            
            // Los goles se registran una vez jugado el partido
            $table->tinyInteger('goles_a')->nullable();
            $table->tinyInteger('goles_b')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partidos');
    }
};