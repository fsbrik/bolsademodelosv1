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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->string('nom_ser', 100);
            $table->enum('cat_ser', ['modelo', 'empresa']);
            $table->enum('sub_cat', ['reservas', 'planes'])->nullable();
            $table->text('des_ser');
            $table->integer('precio');
            $table->boolean('hab_ser');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
