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
        Schema::table('product_category', function (Blueprint $table) {
            $table->foreign(['PRODUCT_ID'], 'PRODUCT_CATEGORY_FK')->references(['ID'])->on('product')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['CATEGORY_ID'], 'PRODUCT_CATEGORY_FK_1')->references(['ID'])->on('category_p')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_category', function (Blueprint $table) {
            $table->dropForeign('PRODUCT_CATEGORY_FK');
            $table->dropForeign('PRODUCT_CATEGORY_FK_1');
        });
    }
};
