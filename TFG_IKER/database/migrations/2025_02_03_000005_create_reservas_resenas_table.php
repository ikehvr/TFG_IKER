<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Anadir columna rol a users si no existe
        if (!Schema::hasColumn('users', 'rol')) {
            Schema::table('users', function (Blueprint $table) {
                $table->enum('rol', ['user', 'admin'])->default('user')->after('email');
            });
        }

        // Tabla reservas
        if (!Schema::hasTable('reservas')) {
            Schema::create('reservas', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('itinerario_id')->constrained()->onDelete('cascade');
                $table->date('fecha_salida');
                $table->unsignedTinyInteger('n_viajeros')->default(1);
                $table->decimal('precio_unitario', 10, 2);
                $table->decimal('total', 10, 2);
                $table->enum('estado', ['pendiente', 'confirmada', 'cancelada', 'completada'])->default('pendiente');
                $table->string('stripe_payment_intent', 100)->nullable();
                $table->text('notas')->nullable();
                $table->timestamps();
            });
        }

        // Tabla resenas
        if (!Schema::hasTable('resenas')) {
            Schema::create('resenas', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('itinerario_id')->constrained()->onDelete('cascade');
                $table->unsignedTinyInteger('puntuacion');
                $table->text('comentario')->nullable();
                $table->boolean('verificada')->default(false);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('resenas');
        Schema::dropIfExists('reservas');
    }
};
