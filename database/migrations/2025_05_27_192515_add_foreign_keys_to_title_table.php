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
        Schema::table('title', function (Blueprint $table) {
            $table->foreign(['USER_ID'], 'title_FK')->references(['ID'])->on('user')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['ROLE_ID'], 'title_FK_1')->references(['ID'])->on('role')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('title', function (Blueprint $table) {
            $table->dropForeign('title_FK');
            $table->dropForeign('title_FK_1');
        });
    }
};
