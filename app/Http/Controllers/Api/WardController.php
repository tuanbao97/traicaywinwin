<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\DistrictService;
use App\Service\WardService;
use Illuminate\Http\Request;

class WardController extends Controller
{
    private WardService $wardService;

    public function __construct(WardService $wardService)
    {
        $this->wardService = $wardService;
    }

    public function getListPhuongXaThiTran(Request $request) {
        return $this->wardService->getListPhuongXaThiTran($request->query('CODE'), $request->query('DISTRICT_CODE'));
    }
}
