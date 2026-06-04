<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('cedula', 32)->unique(); // UNIQUE KEY
            $table->string('nombre', 32);
            $table->string('clave', 128);

            $table->integer('pts_apuestas');
            $table->integer('pts_preguntas');
            
            // Relación con permisos (por defecto 1, con cascade en update)
            $table->foreignId('permiso_id')->default(1)->constrained('permisos')->onUpdate('cascade');

            $table->rememberToken();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};