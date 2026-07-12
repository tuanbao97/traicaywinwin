<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class WinWinNewsCategoryReseedSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        if (Schema::hasTable('news_category')) {
            DB::table('news_category')->truncate();
        }
        if (Schema::hasTable('category_n_document_storage')) {
            DB::table('category_n_document_storage')->truncate();
        }
        if (Schema::hasTable('category_n')) {
            DB::table('category_n')->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call(CategoryNSeeder::class);

        $count = DB::table('category_n')->count();
        $this->command?->info("Đã seed {$count} danh mục tin tức Win Win.");
    }
}
