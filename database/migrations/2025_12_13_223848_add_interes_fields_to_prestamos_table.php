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
        Schema::table('prestamos', function (Blueprint $table) {
            $table->integer('monto_prestado')->after('monto_total');
            $table->integer('porcentaje_interes')->after('monto_prestado');
            $table->integer('monto_mora')->after('porcentaje_interes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prestamos', function (Blueprint $table) {
            $table->dropColumn(['monto_prestado', 'porcentaje_interes', 'monto_mora']);
        });
    }
};
