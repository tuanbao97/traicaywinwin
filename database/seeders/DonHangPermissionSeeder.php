<?php

namespace Database\Seeders;

use App\Enum\AppConstant;
use App\Enum\AuthConstant;
use App\Enum\PermissionEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonHangPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $arrPermission = [
            [
                'CODE' => PermissionEnum::QL_DON_HANG->value,
                'NAME' => PermissionEnum::QL_DON_HANG->description(),
                'PARENT_CODE' => null,
                'TREE_LEVEL' => 1,
                'DESCRIPTION' => PermissionEnum::QL_DON_HANG->description(),
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
                'CODE' => PermissionEnum::QL_DON_HANG_DANH_SACH->value,
                'NAME' => PermissionEnum::QL_DON_HANG_DANH_SACH->description(),
                'PARENT_CODE' => PermissionEnum::QL_DON_HANG->value,
                'TREE_LEVEL' => 2,
                'DESCRIPTION' => PermissionEnum::QL_DON_HANG_DANH_SACH->description(),
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
                'CODE' => PermissionEnum::QL_DON_HANG_CHI_TIET->value,
                'NAME' => PermissionEnum::QL_DON_HANG_CHI_TIET->description(),
                'PARENT_CODE' => PermissionEnum::QL_DON_HANG->value,
                'TREE_LEVEL' => 2,
                'DESCRIPTION' => PermissionEnum::QL_DON_HANG_CHI_TIET->description(),
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
                'CODE' => PermissionEnum::QL_DON_HANG_CHINH_SUA->value,
                'NAME' => PermissionEnum::QL_DON_HANG_CHINH_SUA->description(),
                'PARENT_CODE' => PermissionEnum::QL_DON_HANG->value,
                'TREE_LEVEL' => 2,
                'DESCRIPTION' => PermissionEnum::QL_DON_HANG_CHINH_SUA->description(),
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
                'CODE' => PermissionEnum::QL_DON_HANG_XEM->value,
                'NAME' => PermissionEnum::QL_DON_HANG_XEM->description(),
                'PARENT_CODE' => PermissionEnum::QL_DON_HANG->value,
                'TREE_LEVEL' => 2,
                'DESCRIPTION' => PermissionEnum::QL_DON_HANG_XEM->description(),
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

        foreach ($arrPermission as $permission) {
            $exists = DB::table('permission')->where('CODE', '=', $permission['CODE'])->exists();
            if (! $exists) {
                DB::table('permission')->insert($permission);
            } else {
                DB::table('permission')->where('CODE', '=', $permission['CODE'])->update($permission);
            }
        }

        $arrRolePermission = [
            [
                'ROLE_ID' => 1,
                'PERMISSION_CODE' => PermissionEnum::QL_DON_HANG->value,
                'DESCRIPTION' => PermissionEnum::QL_DON_HANG->description(),
                'SORT_ORDER' => 1,
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
                'ROLE_ID' => 1,
                'PERMISSION_CODE' => PermissionEnum::QL_DON_HANG_DANH_SACH->value,
                'DESCRIPTION' => PermissionEnum::QL_DON_HANG_DANH_SACH->description(),
                'SORT_ORDER' => 2,
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
                'ROLE_ID' => 1,
                'PERMISSION_CODE' => PermissionEnum::QL_DON_HANG_CHI_TIET->value,
                'DESCRIPTION' => PermissionEnum::QL_DON_HANG_CHI_TIET->description(),
                'SORT_ORDER' => 3,
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
                'ROLE_ID' => 1,
                'PERMISSION_CODE' => PermissionEnum::QL_DON_HANG_CHINH_SUA->value,
                'DESCRIPTION' => PermissionEnum::QL_DON_HANG_CHINH_SUA->description(),
                'SORT_ORDER' => 4,
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
                'ROLE_ID' => 1,
                'PERMISSION_CODE' => PermissionEnum::QL_DON_HANG_XEM->value,
                'DESCRIPTION' => PermissionEnum::QL_DON_HANG_XEM->description(),
                'SORT_ORDER' => 5,
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

        foreach ($arrRolePermission as $rolePermission) {
            $exists = DB::table('role_permission')->where([
                ['ROLE_ID', '=', $rolePermission['ROLE_ID']],
                ['PERMISSION_CODE', '=', $rolePermission['PERMISSION_CODE']],
            ])->exists();

            if (! $exists) {
                DB::table('role_permission')->insert($rolePermission);
            } else {
                DB::table('role_permission')->where([
                    ['ROLE_ID', '=', $rolePermission['ROLE_ID']],
                    ['PERMISSION_CODE', '=', $rolePermission['PERMISSION_CODE']],
                ])->update($rolePermission);
            }
        }

        if (function_exists('evictCacheDataFrontEnd')) {
            evictCacheDataFrontEnd();
        }
    }
}
