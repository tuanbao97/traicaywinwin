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
            // Thêm cột PRICE_DISPLAY_TEXT sau PRICE
            $table->string('PRICE_DISPLAY_TEXT', 1000)
                ->nullable()
                ->after('PRICE')
                ->comment('Giá hiển thị ví dụ: 1 tỷ 8xx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            if (Schema::hasColumn('product', 'PRICE_DISPLAY_TEXT')) {
                $table->dropColumn('PRICE_DISPLAY_TEXT');
            }
        });
    }
};


