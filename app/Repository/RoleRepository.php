<?php

namespace App\Repository;

interface RoleRepository extends RepositoryInterface
{
    public function getListRole(?bool $trangThaiHoatDong, ?string $tuKhoa);
}
