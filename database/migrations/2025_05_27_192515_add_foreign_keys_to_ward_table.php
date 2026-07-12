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
        Schema::table('ward', function (Blueprint $table) {
            $table->foreign(['DISTRICT_CODE'], 'wards_district_FK')->references(['CODE'])->on('district')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ward', function (Blueprint $table) {
            $table->dropForeign('wards_district_FK');
        });
    }
};
