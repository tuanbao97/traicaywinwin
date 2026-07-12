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
            $table->text('DESCRIPTION_DETAIL')
                  ->nullable()
                  ->after('TYPE') // Thêm cột sau cột TYPE
                  ->comment('Mô tả chi tiết sản phẩm'); // Thêm comment
            
            $table->text('DESCRIPTION_DETAIL_ONLY_TEXT')
                  ->nullable()
                  ->after('DESCRIPTION_DETAIL') // Thêm cột sau cột TYPE
                  ->comment('Mô tả chi tiết sản phẩm Only Text'); // Thêm comment

            $table->text('PREFERENTIAL_PURCHASES')
                  ->nullable()
                  ->after('DESCRIPTION_DETAIL_ONLY_TEXT') // Thêm cột sau cột TYPE
                  ->comment('Ưu đãi khi mua hàng'); // Thêm comment
            
            $table->text('PREFERENTIAL_PURCHASES_ONLY_TEXT')
                  ->nullable()
                  ->after('PREFERENTIAL_PURCHASES') // Thêm cột sau cột TYPE
                  ->comment('Ưu đãi khi mua hàng Only Text'); // Thêm comment

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn('DESCRIPTION_DETAIL');
            $table->dropColumn('DESCRIPTION_DETAIL_ONLY_TEXT');
            $table->dropColumn('PREFERENTIAL_PURCHASES');
            $table->dropColumn('PREFERENTIAL_PURCHASES_ONLY_TEXT');
        });
    }
};
