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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->foreignId('cliente_id')->constrained('clientes')->cascadeOnDelete();
            $table->foreignId('cobrador_id')->constrained('users')->cascadeOnDelete();
            $table->integer('monto_total');
            $table->integer('monto_cuota');
            $table->integer('cantidad_cuotas');
            $table->integer('total_mora');
            $table->integer('total_pagado');
            $table->integer('cuotas_pagadas');
            $table->integer('saldo_pendiente');
            $table->date('fecha_inicio');
            $table->date('fecha_fin_estimado');
            $table->enum('estado', ['activo', 'completado', 'moroso', 'cancelado']);
            $table->enum('rango', ['semanal', 'quincenal', 'mensual', 'diario']);
            $table->string('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
