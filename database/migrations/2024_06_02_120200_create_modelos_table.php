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
            $table->string('mod_id', 10)->unique();
            //$table->string('nom_ape'); ya esta en la tabla users
            $table->date('fec_nac');
            $table->char('sexo', 1);
            $table->float('estatura')->nullable();
            $table->string('medidas')->nullable();
            $table->float('calzado')->nullable();
            $table->string('zon_res', 100)->nullable();
            $table->boolean('dis_via')->nullable();
            $table->boolean('tit_mod')->nullable();
            $table->enum('ingles', ['basico', 'intermedio', 'avanzado'])->nullable();
            $table->string('dis_tra', 100)->nullable();
            $table->text('descripcion')->nullable();
            $table->float('tar_med')->nullable();
            $table->float('tar_com')->nullable();
            //$table->string('dir_fot')->nullable(); ya esta en la tabla users
            $table->boolean('estado')->default(1);
            $table->boolean('habilita')->default(0);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
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
