<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  // database/migrations/xxxx_create_animaciones_table.php
public function up()
{
    Schema::create('animaciones', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');
        $table->string('duracion');
        $table->string('imagen'); // Ruta de imagen
        $table->foreignId('estudio_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animaciones'); // ← aquí estaba el error
    }
};
