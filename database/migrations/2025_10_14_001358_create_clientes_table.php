<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('nro_ci');
            $table->foreignId('cobrador_id')->constrained('users');
            $table->string('correo');
            $table->integer('telefono');
            $table->string('direccion');
            $table->string('ciudad');
            $table->string('geo');
            $table->string('imagen')->nullable();
            $table->boolean('activo')->nullable();
            $table->string('referencia')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
