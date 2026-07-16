<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('product', 'MA_SAN_PHAM')) {
            DB::statement('ALTER TABLE `product` ADD `MA_SAN_PHAM` VARCHAR(100) NULL AFTER `UUID`');
        }

        // Mặc định mã sản phẩm = ID nếu chưa có
        DB::statement("UPDATE `product` SET `MA_SAN_PHAM` = CAST(`ID` AS CHAR) WHERE `MA_SAN_PHAM` IS NULL OR TRIM(`MA_SAN_PHAM`) = ''");
    }

    public function down(): void
    {
        if (Schema::hasColumn('product', 'MA_SAN_PHAM')) {
            Schema::table('product', function (Blueprint $table) {
                $table->dropColumn('MA_SAN_PHAM');
            });
        }
    }
};
