<?php

namespace App\Repository;


use Illuminate\Support\Collection;

interface ProvinceRepository extends RepositoryInterface
{
    public function saveProvinces(Collection $provinces);

    public function getListTinhThanh(?string $code);
}
