<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\setting\ImportCitiesRequest;
use App\Service\ProvinceService;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    // Inject bean
    private ProvinceService $provinceService;

    public function __construct(ProvinceService $provinceService) {
        $this->provinceService = $provinceService;
    }

    public function importDataCties(ImportCitiesRequest $request) {
        return $this->provinceService->importDataTinhThanhVietNam($request);
    }

    public function getListTinhThanh(Request $request) {
        return $this->provinceService->getListTinhThanh($request);
    }
}
