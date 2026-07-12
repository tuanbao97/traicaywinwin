<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RemoveBatDongSanCategoryPSeeder extends Seeder
{
    public function run(): void
    {
        // Nhóm seed cũ liên quan bất động sản (ID 1..15)
        $ids = range(1, 15);

        // Gỡ liên kết sản phẩm - danh mục (nếu có)
        if (Schema::hasTable('product_category')) {
            DB::table('product_category')->whereIn('CATEGORY_ID', $ids)->delete();
        }

        // Gỡ file đính kèm của danh mục (nếu có)
        if (Schema::hasTable('category_p_document_storage')) {
            DB::table('category_p_document_storage')->whereIn('CATEGORY_P_ID', $ids)->delete();
        }

        // Xóa con trước, rồi xóa cha (để tránh constraint tự tạo)
        DB::table('category_p')->whereIn('PARENT_ID', $ids)->delete();
        DB::table('category_p')->whereIn('ID', $ids)->delete();
    }
}

