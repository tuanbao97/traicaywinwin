<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrNews = [
            // Add your news data here
        ];

        foreach ($arrNews as $index => $news) {
            $exists = DB::table('news')->where([
                ['ID', '=', $news['ID']]
            ])->exists();

            if (!$exists) {
                DB::table('news')->insert($news);
            } else {
                DB::table('news')->where([
                    ['ID', '=', $news['ID']]
                ])->update($news);
            }
        }
    }
}
