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
        Schema::table('servicios', function (Blueprint $table) {
            $table->enum('sub_cat', ['reservas', 'contrataciones'])->nullable()->after('cat_ser');
        });
    }
    
    public function down()
    {
        Schema::table('servicios', function (Blueprint $table) {
            $table->dropColumn('sub_cat');
        });
    }
};
