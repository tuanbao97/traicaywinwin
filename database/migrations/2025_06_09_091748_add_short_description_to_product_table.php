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
            $table->string('SHORT_DESCRIPTION', 255)
                  ->nullable()
                  ->after('TYPE') // Thêm cột sau cột TYPE
                  ->comment('Mô tả ngắn gọn sản phẩm'); // Thêm comment
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn('SHORT_DESCRIPTION');
        });
    }
};
