<?php

namespace App\Service;

use Illuminate\Http\Request;

interface ProvinceService
{

    public function importDataTinhThanhVietNam(Request $request);

    public function getListTinhThanh(Request $request);
}
