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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->foreignId('prestamo_id')->constrained('prestamos')->cascadeOnDelete();
            $table->foreignId('cobrador_id')->constrained('users')->cascadeOnDelete();
            $table->integer('monto_pagado');
            $table->integer('monto_esperado');
            $table->integer('numero_cuota');
            $table->enum('estado', ['pagado', 'parcial', 'no_pagado', 'pendiente']);
            $table->date('vencimiento');
            $table->date('fecha_pago')->nullable();
            $table->string('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
