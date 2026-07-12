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
        Schema::table('news', function (Blueprint $table) {
            $table->foreign(['USER_POST_NEWS_ID'], 'NEWS_FK')->references(['ID'])->on('user')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['USER_APPROVED_POST_NEWS_ID'], 'NEWS_FK_1')->references(['ID'])->on('user')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign('NEWS_FK');
            $table->dropForeign('NEWS_FK_1');
        });
    }
};
