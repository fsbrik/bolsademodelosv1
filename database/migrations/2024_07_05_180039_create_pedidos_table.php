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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->date('fec_ini');
            $table->date('fec_fin')->nullable();
            $table->unsignedBigInteger('conf_ini')->default(0); // recupera la suma de las confirmaciones provenientes de los planes anteriores
            $table->unsignedBigInteger('creditos')->nullable();
            $table->integer('total');
            $table->boolean('habilita')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
