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
        Schema::table('news_document_storage', function (Blueprint $table) {
            $table->foreign(['NEWS_ID'], 'NEWS_DOCUMENT_STORAGE_FK')->references(['ID'])->on('news')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['DOCUMENT_STORAGE_ID'], 'NEWS_DOCUMENT_STORAGE_FK_1')->references(['ID'])->on('document_storage')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news_document_storage', function (Blueprint $table) {
            $table->dropForeign('NEWS_DOCUMENT_STORAGE_FK');
            $table->dropForeign('NEWS_DOCUMENT_STORAGE_FK_1');
        });
    }
};
