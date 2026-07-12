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
        Schema::table('product_variant', function (Blueprint $table) {
            $table->foreign(['PRODUCT_IMAGE_ID'], 'product_variant_document_storage_fk')->references(['ID'])->on('document_storage')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['PRODUCT_ID'], 'product_variant_product_FK')->references(['ID'])->on('product')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_variant', function (Blueprint $table) {
            $table->dropForeign('product_variant_document_storage_fk');
            $table->dropForeign('product_variant_product_FK');
        });
    }
};
