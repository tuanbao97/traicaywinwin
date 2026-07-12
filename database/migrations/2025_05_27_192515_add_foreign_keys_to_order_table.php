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
        Schema::table('order', function (Blueprint $table) {
            $table->foreign(['TRANSACTION_ID'], 'ORDER_FK')->references(['ID'])->on('transaction')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['PRODUCT_ID'], 'ORDER_FK_1')->references(['ID'])->on('product')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order', function (Blueprint $table) {
            $table->dropForeign('ORDER_FK');
            $table->dropForeign('ORDER_FK_1');
        });
    }
};
