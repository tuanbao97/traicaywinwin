<?php

namespace App\Service\impl;

use App\Dto\response\ApiResponseDto;
use App\Enum\AppConstant;
use App\Mapper\DistrictMapper;
use App\Models\District;
use App\Repository\DistrictRepository;
use App\Service\DistrictService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DistrictServiceImpl implements DistrictService
{

    // Inject beans
    private DistrictRepository $districtRepository;

    public function __construct(DistrictRepository $districtRepository)
    {
        $this->districtRepository = $districtRepository;
    }

    public function getListQuanHuyen(?string $code, ?string $provinceCode) {
        $result = $this->districtRepository->getListQuanHuyen($code, $provinceCode);
        $resultDto = DistrictMapper::mapListDistrictDto($result);

        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Truy vấn thành công.'
                , [
                    class_basename(District::class) . '_total' => $resultDto->count(),
                    class_basename(District::class) => $resultDto
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }
    
}
