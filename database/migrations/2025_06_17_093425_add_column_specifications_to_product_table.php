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
            $table->text('SPECIFICATIONS')
                  ->nullable()
                  ->after('PREFERENTIAL_PURCHASES_ONLY_TEXT')
                  ->comment('Thông số kĩ thuật sản phẩm'); // Thêm comment
            
            $table->text('SPECIFICATIONS_ONLY_TEXT')
                  ->nullable()
                  ->after('SPECIFICATIONS')
                  ->comment('Thông số kĩ thuật sản phẩm Only Text'); // Thêm comment
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn('SPECIFICATIONS');
            $table->dropColumn('SPECIFICATIONS_ONLY_TEXT');
        });
    }
};
