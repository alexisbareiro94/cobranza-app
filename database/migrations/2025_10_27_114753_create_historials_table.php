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
        Schema::create('historiales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cobrador_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('prestamo_id')->constrained('prestamos');
            $table->enum('estado', ['pagado', 'no_pagado', 'pendiente']);
            $table->foreignId('pago_id')->constrained('pagos');
            $table->integer('monto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historiales');
    }
};
