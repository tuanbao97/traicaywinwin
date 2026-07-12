<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class WinWinMenuReseedSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        if (Schema::hasTable('order')) {
            DB::table('order')->truncate();
        }
        if (Schema::hasTable('product_variant')) {
            DB::table('product_variant')->truncate();
        }
        if (Schema::hasTable('product_document_storage')) {
            DB::table('product_document_storage')->truncate();
        }
        if (Schema::hasTable('product_category')) {
            DB::table('product_category')->truncate();
        }
        if (Schema::hasTable('product')) {
            DB::table('product')->truncate();
        }
        if (Schema::hasTable('category_p_document_storage')) {
            DB::table('category_p_document_storage')->truncate();
        }
        if (Schema::hasTable('category_p')) {
            DB::table('category_p')->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call(CategoryPSeeder::class);
    }
}
