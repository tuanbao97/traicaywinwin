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
        Schema::table('news_category', function (Blueprint $table) {
            $table->foreign(['NEWS_ID'], 'NEWS_CATEGORY_FK')->references(['ID'])->on('news')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['CATEGORY_ID'], 'NEWS_CATEGORY_FK_1')->references(['ID'])->on('category_n')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news_category', function (Blueprint $table) {
            $table->dropForeign('NEWS_CATEGORY_FK');
            $table->dropForeign('NEWS_CATEGORY_FK_1');
        });
    }
};
