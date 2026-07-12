<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RemoveGioTraiCayPriceCategorySeeder extends Seeder
{
    /**
     * Xóa danh mục con "Giỏ trái cây ... kèm giá" khỏi DB.
     * UI trang chủ hardcode các mức giá → search với gia_tu/gia_den.
     */
    public function run(): void
    {
        $ids = [1043, 1044, 1045, 1046, 1047];

        if (Schema::hasTable('product_category')) {
            DB::table('product_category')->whereIn('CATEGORY_ID', $ids)->delete();
        }

        if (Schema::hasTable('category_p_document_storage')) {
            DB::table('category_p_document_storage')->whereIn('CATEGORY_P_ID', $ids)->delete();
        }

        DB::table('category_p')->whereIn('ID', $ids)->delete();
    }
}
