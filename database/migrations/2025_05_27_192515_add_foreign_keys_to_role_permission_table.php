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
        Schema::table('role_permission', function (Blueprint $table) {
            $table->foreign(['ROLE_ID'], 'ROLE_PERMISSION_FK')->references(['ID'])->on('role')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['PERMISSION_CODE'], 'ROLE_PERMISSION_FK_1')->references(['CODE'])->on('permission')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('role_permission', function (Blueprint $table) {
            $table->dropForeign('ROLE_PERMISSION_FK');
            $table->dropForeign('ROLE_PERMISSION_FK_1');
        });
    }
};
