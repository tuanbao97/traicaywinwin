<?php

namespace App\Service;

use Illuminate\Http\Request;

interface DistrictService
{

    public function getListQuanHuyen(?string $code, ?string $provinceCode);

}
