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
        Schema::table('category_p_document_storage', function (Blueprint $table) {
            $table->foreign(['DOCUMENT_STORAGE_ID'], 'category_p_document_storage_fk')->references(['ID'])->on('document_storage')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['CATEGORY_P_ID'], 'category_p_document_storage_fk_1')->references(['ID'])->on('category_p')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category_p_document_storage', function (Blueprint $table) {
            $table->dropForeign('category_p_document_storage_fk');
            $table->dropForeign('category_p_document_storage_fk_1');
        });
    }
};
