<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface WardRepository
{
    public function saveWards(Collection $wards);

    public function getListPhuongXaThiTran(?string $code, ?string $districtCode);

}
