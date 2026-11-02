<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // La tabla reseñas ya fue creada en la migración anterior
        // Esta migración no hace nada si ya existe
        if (!Schema::hasTable('resenas')) {
            Schema::create('resenas', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('itinerario_id')->constrained()->onDelete('cascade');
                $table->unsignedTinyInteger('puntuacion'); // 1-5
                $table->text('comentario')->nullable();
                $table->boolean('verificada')->default(true);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('resenas');
    }
};
