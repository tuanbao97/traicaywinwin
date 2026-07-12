<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('product', function (Blueprint $table) {
            if (!Schema::hasColumn('product', 'PRODUCT_VIP')) {
                $table->boolean('PRODUCT_VIP')
                    ->nullable()
                    ->default(false)
                    ->after('PRODUCT_HOT')
                    ->comment('Sản phẩm hiển thị ở Chớp thời cơ. Giá như mơ!');
            }
        });

        // Giữ hành vi cũ: sản phẩm từng gắn PRODUCT_HOT (flash sale) vẫn hiện ở chớp thời cơ
        if (Schema::hasColumn('product', 'PRODUCT_VIP') && Schema::hasColumn('product', 'PRODUCT_HOT')) {
            DB::table('product')
                ->where('PRODUCT_HOT', true)
                ->update(['PRODUCT_VIP' => true]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            if (Schema::hasColumn('product', 'PRODUCT_VIP')) {
                $table->dropColumn('PRODUCT_VIP');
            }
        });
    }
};
