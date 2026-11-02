<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItinerarioDestinosTable extends Migration
{
    public function up()
    {
        Schema::create('itinerario_destinos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('itinerario_id')->constrained()->onDelete('cascade');
            $table->foreignId('destino_id')->constrained()->onDelete('cascade');
            $table->integer('orden');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('itinerario_destinos');
    }
}