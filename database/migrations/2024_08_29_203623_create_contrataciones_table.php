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
        Schema::create('contrataciones', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('empresa_id')->constrained()->onDelete('cascade');
            $table->date('fec_con'); // Fecha de contratación
            $table->date('fec_ini'); // Fecha de inicio
            $table->date('fec_fin'); // Fecha de fin
            $table->integer('hor_dia'); // Horas por día
            $table->string('dom_tra'); // Domicilio
            $table->string('loc_tra'); // Localidad
            $table->string('pro_tra'); // Provincia
            $table->string('pai_tra'); // País
            $table->decimal('mon_tot', 10, 2); // Monto total
            $table->text('des_tra'); // Descripción del trabajo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrataciones');
    }
};
