<?php

namespace App\Repository\impl;

use App\Models\Role;
use App\Repository\BaseRepository;
use App\Repository\RoleRepository;

class RoleRepositoryImpl extends BaseRepository implements RoleRepository
{
    public function getModel()
    {
        return Role::class;
    }

    public function getListRole(?bool $trangThaiHoatDong, ?string $tuKhoa) {
        $query = Role::query();

        // Tìm kiếm theo từ khóa
        // Tạo thành 1 block where theo điều kiện này
        if (!blank($tuKhoa)) {
            $query->where(
                function($query) use ($tuKhoa) {
                    $query->where([
                        ['NAME', 'like', '%' . $tuKhoa . '%']
                    ])
                    ->orWhere([
                        ['NAME', 'like', '%' . $tuKhoa . '%']
                    ]);
                }
            );
        }

        if (!is_null($trangThaiHoatDong)) {
            $query->where([
                ['IS_ACTIVE', '=', $trangThaiHoatDong]
            ]);
        }

        return $query->orderBy('CRT_DT', 'desc')
                     ->get();

    }

}
