<?php

namespace Database\Seeders;

use App\Enum\AppConstant;
use App\Enum\AuthConstant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryPSeeder extends Seeder
{
    /**
     * Danh mục sản phẩm Win Win — theo menu thực tế cửa hàng.
     */
    public function run(): void
    {
        $arrCategoryP = [
            $this->row(1004, 'Giỏ quà trái cây', 1, 0, null),
            $this->row(1041, 'Mẫu giỏ trái cây đẹp', 1, 1, 1004),
            $this->row(1042, 'Giỏ trái cây đám tang', 2, 1, 1004),

            $this->row(1005, 'Hộp quà trái cây', 2, 0, null),

            $this->row(1001, 'Trái cây nhập khẩu', 3, 0, null),
            $this->row(1002, 'Trái cây sấy', 4, 0, null),
            $this->row(1003, 'Yến sào Cao Cấp', 5, 0, null),
            $this->row(1006, 'Bánh kẹo nhập khẩu', 6, 0, null),
            $this->row(1007, 'Tháp Bánh Kẹo', 7, 0, null),
            $this->row(1008, 'Sữa & Sữa chua', 8, 0, null),
        ];

        foreach ($arrCategoryP as $categoryP) {
            $exists = DB::table('category_p')->where('ID', $categoryP['ID'])->exists();

            if (!$exists) {
                DB::table('category_p')->insert($categoryP);
            } else {
                DB::table('category_p')->where('ID', $categoryP['ID'])->update($categoryP);
            }
        }

        // Menu "Đồ chơi" không còn trong DB — FE hardcode link ngoài
        DB::table('category_p')
            ->where(function ($q) {
                $q->where('ID', 1009)->orWhere('NAME', 'Đồ chơi trẻ em');
            })
            ->update([
                'STATUS' => AppConstant::STATUS_DELETED,
                'IS_ACTIVE' => false,
                'UPD_DT' => now(),
                'UPD_ID' => AuthConstant::USER_SUPER_ADMIN_ID,
                'UPD_NAME' => AuthConstant::USER_SUPER_ADMIN_FULL_NAME,
            ]);
    }

    private function row(int $id, string $name, int $sortOrder, int $treeLevel, ?int $parentId, ?string $externalUrl = null): array
    {
        return [
            'ID' => $id,
            'NAME' => $name,
            'SORT_ORDER' => $sortOrder,
            'TREE_LEVEL' => $treeLevel,
            'PARENT_ID' => $parentId,
            'CRT_DT' => now(),
            'UPD_DT' => now(),
            'CRT_ID' => AuthConstant::USER_SUPER_ADMIN_ID,
            'UPD_ID' => AuthConstant::USER_SUPER_ADMIN_ID,
            'CRT_NAME' => AuthConstant::USER_SUPER_ADMIN_FULL_NAME,
            'UPD_NAME' => AuthConstant::USER_SUPER_ADMIN_FULL_NAME,
            'STATUS' => AppConstant::STATUS_USING,
            'IS_ACTIVE' => true,
            'ATTR1' => $externalUrl,
            'ATTR50' => 'UI-BACKEND/admin/san-pham/common/san-pham',
        ];
    }
}
