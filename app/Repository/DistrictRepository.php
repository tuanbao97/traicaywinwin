<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface DistrictRepository extends RepositoryInterface
{

    public function saveQuanHuyen(Collection $districts);

    public function getListQuanHuyen(?string $code, ?string $provinceCode);
}
