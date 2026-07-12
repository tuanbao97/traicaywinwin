<?php

namespace Database\Seeders;

use App\Enum\AppConstant;
use App\Enum\AuthConstant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryNSeeder extends Seeder
{
    public function run(): void
    {
        $arrCategoryN = [
            [
                'ID' => 1,
                'NAME' => 'Mẹo chọn & bảo quản trái cây',
                'SORT_ORDER' => 1,
                'TREE_LEVEL' => 0,
                'PARENT_ID' => null,
                'DESCRIPTION' => 'Hướng dẫn chọn trái tươi ngon và cách bảo quản tại nhà.',
                'CRT_DT' => now(),
                'UPD_DT' => now(),
                'CRT_ID' => AuthConstant::USER_SUPER_ADMIN_ID,
                'UPD_ID' => AuthConstant::USER_SUPER_ADMIN_ID,
                'CRT_NAME' => AuthConstant::USER_SUPER_ADMIN_FULL_NAME,
                'UPD_NAME' => AuthConstant::USER_SUPER_ADMIN_FULL_NAME,
                'STATUS' => AppConstant::STATUS_USING,
                'IS_ACTIVE' => true,
            ],
            [
                'ID' => 2,
                'NAME' => 'Quà tặng & giỏ quà',
                'SORT_ORDER' => 2,
                'TREE_LEVEL' => 0,
                'PARENT_ID' => null,
                'DESCRIPTION' => 'Gợi ý combo quà tặng, giỏ quà trái cây cho dịp lễ và sự kiện.',
                'CRT_DT' => now(),
                'UPD_DT' => now(),
                'CRT_ID' => AuthConstant::USER_SUPER_ADMIN_ID,
                'UPD_ID' => AuthConstant::USER_SUPER_ADMIN_ID,
                'CRT_NAME' => AuthConstant::USER_SUPER_ADMIN_FULL_NAME,
                'UPD_NAME' => AuthConstant::USER_SUPER_ADMIN_FULL_NAME,
                'STATUS' => AppConstant::STATUS_USING,
                'IS_ACTIVE' => true,
            ],
            [
                'ID' => 3,
                'NAME' => 'Tin cửa hàng',
                'SORT_ORDER' => 3,
                'TREE_LEVEL' => 0,
                'PARENT_ID' => null,
                'DESCRIPTION' => 'Khuyến mãi, sản phẩm mới và thông tin hoạt động cửa hàng Win Win.',
                'CRT_DT' => now(),
                'UPD_DT' => now(),
                'CRT_ID' => AuthConstant::USER_SUPER_ADMIN_ID,
                'UPD_ID' => AuthConstant::USER_SUPER_ADMIN_ID,
                'CRT_NAME' => AuthConstant::USER_SUPER_ADMIN_FULL_NAME,
                'UPD_NAME' => AuthConstant::USER_SUPER_ADMIN_FULL_NAME,
                'STATUS' => AppConstant::STATUS_USING,
                'IS_ACTIVE' => true,
            ],
        ];

        foreach ($arrCategoryN as $categoryN) {
            DB::table('category_n')->updateOrInsert(
                ['ID' => $categoryN['ID']],
                $categoryN
            );
        }
    }
}
