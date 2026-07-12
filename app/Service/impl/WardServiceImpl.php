<?php

namespace App\Service\impl;

use App\Dto\response\ApiResponseDto;
use App\Enum\AppConstant;
use App\Mapper\WardMapper;
use App\Models\Ward;
use App\Repository\WardRepository;
use App\Service\WardService;
use Illuminate\Http\JsonResponse;

class WardServiceImpl implements WardService
{
    private WardRepository $wardRepository;

    public function __construct(WardRepository $wardRepository)
    {
        $this->wardRepository = $wardRepository;
    }

    public function getListPhuongXaThiTran(?string $code, ?string $districtCode) {
        $result = $this->wardRepository->getListPhuongXaThiTran($code, $districtCode);
        $resultDto = WardMapper::mapListWardDto($result);

        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Truy vấn thành công.'
                , [
                    class_basename(Ward::class) . '_total' => $resultDto->count(),
                    class_basename(Ward::class) => $resultDto
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

}
