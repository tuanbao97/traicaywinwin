<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\DistrictService;
use Illuminate\Http\Request;

class DistrictController extends Controller
{

    // Inject beans
    private DistrictService $districtService;

    public function __construct(DistrictService $districtService)
    {
        $this->districtService = $districtService;
    }

    public function getListQuanHuyen(Request $request) {
        return $this->districtService->getListQuanHuyen($request->query('CODE'), $request->query('PROVINCE_CODE'));
    }
}
