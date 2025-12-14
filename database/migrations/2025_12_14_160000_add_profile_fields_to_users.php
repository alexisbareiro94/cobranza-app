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
        Schema::table('users', function (Blueprint $table) {
            $table->string('foto_perfil')->nullable()->after('password');
            $table->string('telefono')->nullable()->after('foto_perfil');
            $table->string('nombre_negocio')->nullable()->after('telefono');
            $table->string('direccion_oficina')->nullable()->after('nombre_negocio');
            $table->string('horario_atencion')->nullable()->after('direccion_oficina');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'foto_perfil',
                'telefono',
                'nombre_negocio',
                'direccion_oficina',
                'horario_atencion'
            ]);
        });
    }
};
