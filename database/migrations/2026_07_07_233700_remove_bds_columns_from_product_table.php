<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $columns = [
                'DIEN_TICH',
                'CHIEU_NGANG',
                'CHIEU_DAI',
                'GOOGLE_MAP_PINS_POSITION',
                'ADDRESS_PROVINE_CODE',
                'ADDRESS_DISTRICT_CODE',
                'ADDRESS_WARD_CODE',
                'ADDRESS_ROAD_NAME',
                'ADDRESS_NUMBER',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('product', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            if (!Schema::hasColumn('product', 'ADDRESS_PROVINE_CODE')) {
                $table->string('ADDRESS_PROVINE_CODE', 1000)->nullable()->after('TYPE');
                $table->string('ADDRESS_DISTRICT_CODE', 1000)->nullable();
                $table->string('ADDRESS_WARD_CODE', 1000)->nullable();
                $table->string('ADDRESS_ROAD_NAME', 2000)->nullable();
                $table->string('ADDRESS_NUMBER', 1000)->nullable();
            }
            if (!Schema::hasColumn('product', 'DIEN_TICH')) {
                $table->double('DIEN_TICH')->nullable()->after('PRODUCT_TAGS');
                $table->double('CHIEU_NGANG')->nullable()->after('DIEN_TICH');
                $table->double('CHIEU_DAI')->nullable()->after('CHIEU_NGANG');
            }
            if (!Schema::hasColumn('product', 'GOOGLE_MAP_PINS_POSITION')) {
                $table->string('GOOGLE_MAP_PINS_POSITION', 3000)->nullable()->after('ADDRESS_NUMBER');
            }
        });
    }
};
