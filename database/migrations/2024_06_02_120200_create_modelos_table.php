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
        Schema::create('modelos', function (Blueprint $table) {
            $table->id();
            $table->string('mod_id')->unique();
            $table->string('nom_ape');
            $table->date('fec_nac');
            $table->char('sexo', 1);
            $table->float('estatura');
            $table->string('medidas');
            $table->string('calzado');
            $table->string('zon_res');
            $table->boolean('dis_via');
            $table->boolean('tit_mod');
            $table->enum('ingles', ['basico', 'intermedio', 'avanzado']);
            $table->string('dis_tra');
            $table->text('descripcion');
            $table->float('tar_med');
            $table->float('tar_com');
            $table->string('dir_fot');
            $table->boolean('activo');
            $table->boolean('habilita');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modelos');
    }
};
