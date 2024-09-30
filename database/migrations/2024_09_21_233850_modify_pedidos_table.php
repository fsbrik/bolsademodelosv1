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
        Schema::table('pedidos', function (Blueprint $table) {
            // Agregar el campo empresa_id (nullable) luego de user_id
            $table->unsignedBigInteger('empresa_id')->nullable()->after('user_id');

            // Agregar campo booleano 'habilita' después de 'total', por defecto 0
            $table->boolean('habilita')->nullable()->after('total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            // Eliminar los campos agregados y restaurar el estado anterior
            $table->dropColumn('empresa_id');
            $table->dropColumn('habilita');
        });
    }
};
