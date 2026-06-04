<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->id(); // int(11) AUTO_INCREMENT
            $table->string('nombre', 12);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permisos');
    }
};