<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinosTable extends Migration
{
    public function up()
    {
        Schema::create('destinos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('ciudad');
            $table->text('descripcion')->nullable();
            $table->string('imagen_url')->nullable();
            $table->enum('tipo', ['cultura', 'moderno', 'anime', 'naturaleza', 'gastronomia']);
            $table->decimal('precio_estimado', 8, 2)->default(0);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('destinos');
    }
}