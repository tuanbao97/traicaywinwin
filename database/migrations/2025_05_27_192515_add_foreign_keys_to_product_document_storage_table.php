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
        Schema::table('product_document_storage', function (Blueprint $table) {
            $table->foreign(['PRODUCT_ID'], 'PRODUCT_DOCUMENT_STORAGE_FK')->references(['ID'])->on('product')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['DOCUMENT_STORAGE_ID'], 'PRODUCT_DOCUMENT_STORAGE_FK_1')->references(['ID'])->on('document_storage')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_document_storage', function (Blueprint $table) {
            $table->dropForeign('PRODUCT_DOCUMENT_STORAGE_FK');
            $table->dropForeign('PRODUCT_DOCUMENT_STORAGE_FK_1');
        });
    }
};
