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
        Schema::create('configuracion_prestamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->decimal('tasa_interes_default', 5, 2)->default(10.00);
            $table->integer('monto_mora_default')->default(5000);
            $table->integer('monto_minimo')->default(100000);
            $table->integer('monto_maximo')->default(10000000);
            $table->integer('cuotas_minimas')->default(1);
            $table->integer('cuotas_maximas')->default(24);
            $table->integer('dias_gracia')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracion_prestamos');
    }
};
