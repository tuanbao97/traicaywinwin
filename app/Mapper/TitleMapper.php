<?php

namespace App\Mapper;

use App\Dto\title\TitleDetailDto;
use App\Models\Title;

class TitleMapper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function maptitileDetailDtoDtoFromEntity(?Title $title): ?TitleDetailDto {
        if ($title == null) return null;

        $titileDetailDto = TitleDetailDto::createEmpty();

        $titileDetailDto->id = $title->ID;
        $titileDetailDto->userId = $title->USER_ID;
        $titileDetailDto->roleId = $title->ROLE_ID;
        $titileDetailDto->description = $title->DESCRIPTION;
        $titileDetailDto->sortOrder = $title->SORT_ORDER;
        $titileDetailDto->roleName = $title->ROLE_NAME;
        
        // Thông tin modire và trạng thái hoạt động
        $titileDetailDto->crtId = $title->CRT_ID;
        $titileDetailDto->crtDt = $title->CRT_DT;
        $titileDetailDto->updId = $title->UPD_ID;
        $titileDetailDto->updDt = $title->UPD_DT;
        $titileDetailDto->crtName = $title->CRT_NAME;
        $titileDetailDto->updName = $title->UPD_NAME;
        $titileDetailDto->status = $title->STATUS;
        if (!is_null($title->IS_ACTIVE)) $titileDetailDto->isActive = filter_var($title->IS_ACTIVE, FILTER_VALIDATE_BOOLEAN);

        return $titileDetailDto;
    }

}
