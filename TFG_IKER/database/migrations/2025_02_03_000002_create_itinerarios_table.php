<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItinerariosTable extends Migration
{
    public function up()
    {
        Schema::create('itinerarios', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->text('descripcion_corta');
            $table->text('descripcion_larga')->nullable();
            $table->integer('duracion_dias');
            $table->enum('categoria', ['tradicional', 'moderno', 'anime', 'naturaleza', 'mixto']);
            $table->enum('presupuesto', ['economico', 'medio', 'lujo'])->default('medio');
            $table->enum('primera_vez', ['si', 'no'])->default('si');
            $table->decimal('precio_desde', 10, 2);
            $table->string('imagen_principal');
            $table->string('destino_principal');
            $table->boolean('recomendado')->default(false);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('itinerarios');
    }
}