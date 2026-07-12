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
            // Thêm cột KEYWORDS_SEO_WEBSITE sau POST_DETAIL_DESCRIPTION
            $table->string('KEYWORDS_SEO_WEBSITE', 500)
                ->after('POST_DETAIL_DESCRIPTION')
                ->comment('Từ khóa SEO website');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn('KEYWORDS_SEO_WEBSITE');
        });
    }
};
