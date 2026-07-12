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
        Schema::table('product', function (Blueprint $table) {
            $table->double('DIEN_TICH')->nullable()->comment('Diện tích sản phẩm')->after('PRODUCT_TAGS');
            $table->double('CHIEU_NGANG')->nullable()->comment('Chiều ngang sản phẩm')->after('DIEN_TICH');
            $table->double('CHIEU_DAI')->nullable()->comment('Chiều dài sản phẩm')->after('CHIEU_NGANG');
            $table->string('GOOGLE_MAP_PINS_POSITION', 3000)->nullable()->comment('Vị trí ghim Google map')->after('ADDRESS_NUMBER');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn(['DIEN_TICH', 'CHIEU_NGANG', 'CHIEU_DAI', 'GOOGLE_MAP_PINS_POSITION']);
        });
    }
};
