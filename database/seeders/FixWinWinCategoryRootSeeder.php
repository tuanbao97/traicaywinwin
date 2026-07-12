<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FixWinWinCategoryRootSeeder extends Seeder
{
    public function run(): void
    {
        // Tìm root dạng "Win Win — Cửa hàng" (tên có thể thay đổi dấu "—")
        $root = DB::table('category_p')
            ->whereNull('PARENT_ID')
            ->where('NAME', 'like', '%Win Win%')
            ->where('NAME', 'like', '%Cửa hàng%')
            ->first();

        if (!$root) {
            return;
        }

        $rootId = (int) $root->ID;

        // Đưa tất cả menu con trực tiếp lên làm root
        $children = DB::table('category_p')
            ->where('PARENT_ID', '=', $rootId)
            ->get(['ID']);

        $childIds = $children->pluck('ID')->map(fn ($v) => (int) $v)->all();

        if (count($childIds) > 0) {
            DB::table('category_p')
                ->whereIn('ID', $childIds)
                ->update([
                    'PARENT_ID' => null,
                    'TREE_LEVEL' => 0,
                ]);

            // Giảm TREE_LEVEL của toàn bộ descendant xuống 1 cấp (nếu có)
            // Lặp theo tầng để cập nhật nhiều cấp con.
            $frontier = $childIds;
            while (count($frontier) > 0) {
                $desc = DB::table('category_p')
                    ->whereIn('PARENT_ID', $frontier)
                    ->get(['ID']);

                $descIds = $desc->pluck('ID')->map(fn ($v) => (int) $v)->all();
                if (count($descIds) === 0) break;

                DB::table('category_p')
                    ->whereIn('ID', $descIds)
                    ->update([
                        'TREE_LEVEL' => DB::raw('GREATEST(COALESCE(TREE_LEVEL, 0) - 1, 0)'),
                    ]);

                $frontier = $descIds;
            }
        }

        // Xóa root để menu chỉ còn 1 cấp root
        DB::table('category_p')->where('ID', '=', $rootId)->delete();
    }
}

