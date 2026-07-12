<?php

namespace Database\Seeders;

use App\Enum\AppConstant;
use App\Enum\AuthConstant;
use App\Enum\TitleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrTitle = [
            /* ADMIN */
            [
                'ID' => 1,
                'USER_ID' => 1,
                'ROLE_ID' => TitleEnum::TITLE_ROLE_ADMIN->withRoleId(),
                'DESCRIPTION' => TitleEnum::TITLE_ROLE_ADMIN->description(),
                'SORT_ORDER' => 1,
                'CRT_DT' => now(),
                'UPD_DT' => now(),
                'CRT_ID' => AuthConstant::USER_SUPER_ADMIN_ID,
                'UPD_ID' => AuthConstant::USER_SUPER_ADMIN_ID,
                'CRT_NAME' => AuthConstant::USER_SUPER_ADMIN_FULL_NAME,
                'UPD_NAME' => AuthConstant::USER_SUPER_ADMIN_FULL_NAME,
                'STATUS' => AppConstant::STATUS_USING,
                'IS_ACTIVE' => true
            ],
            [
                'ID' => 2,
                'USER_ID' => 1,
                'ROLE_ID' => TitleEnum::TITLE_ROLE_CHUYEN_VIEN->withRoleId(),
                'DESCRIPTION' => TitleEnum::TITLE_ROLE_CHUYEN_VIEN->description(),
                'SORT_ORDER' => 2,
                'CRT_DT' => now(),
                'UPD_DT' => now(),
                'CRT_ID' => AuthConstant::USER_SUPER_ADMIN_ID,
                'UPD_ID' => AuthConstant::USER_SUPER_ADMIN_ID,
                'CRT_NAME' => AuthConstant::USER_SUPER_ADMIN_FULL_NAME,
                'UPD_NAME' => AuthConstant::USER_SUPER_ADMIN_FULL_NAME,
                'STATUS' => AppConstant::STATUS_USING,
                'IS_ACTIVE' => false
            ],

        ];

        foreach ($arrTitle as $index => $title) {
            $exists = DB::table('title')->where([
                ['ID', '=', $title['ID']]
            ])->exists();

            if (!$exists) {
                DB::table('title')->insert($title);
            } else {
                DB::table('title')->where([
                    ['ID', '=', $title['ID']]
                ])->update($title);
            }
        }
    }
    
}
