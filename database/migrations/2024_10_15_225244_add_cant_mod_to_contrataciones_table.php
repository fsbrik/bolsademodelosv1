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
        Schema::table('contrataciones', function (Blueprint $table) {
            $table->unsignedBigInteger('cant_mod')->after('mon_tot')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contrataciones', function (Blueprint $table) {
            $table->dropColumn('cant_mod');
        });
    }
};
