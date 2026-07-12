<?php

namespace App\Service\impl;

use App\Dto\response\ApiResponseDto;
use App\Enum\AppConstant;
use App\Mapper\RoleMapper;
use App\Models\Role;
use App\Repository\RoleRepository;
use App\Service\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleServiceImpl implements RoleService
{
    // Inject beans
    private RoleRepository $roleRepository;

    /**
     * Create a new class instance.
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getListRole(Request $request) {
        // Get input
        $trangThaiHoatDong = $request->input('TRANG_THAI_HOAT_DONG', null);
        $tuKhoa = $request->input('TU_KHOA', null);
        
        $result = $this->roleRepository->getListRole($trangThaiHoatDong, $tuKhoa);
        // Mapping entity to dto
        $listRoleDetailDto = RoleMapper::mapListRoleDetailFromPaginator($result);

        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Truy vấn thành công.'
                , [
                    camelToSnakeUpper(class_basename(Role::class)) => $listRoleDetailDto
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }
}
