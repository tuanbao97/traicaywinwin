<?php

namespace App\Mapper;

use App\Dto\role\RoleDetailDto;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class RoleMapper
{
    public static function mapFromArray(Role $role, array $data) : ?Role {
        if ($role == null) return null;

        $role->ID = self::issetkey($data, 'ID');
        $role->CODE = self::issetkey($data, 'CODE');
        $role->NAME = self::issetkey($data, 'NAME');
        $role->DESCRIPTION = self::issetkey($data, 'MO_TA');
        $role->IS_ACTIVE = filter_var(self::issetkey($data, 'TRANG_THAI_HOAT_DONG', true), FILTER_VALIDATE_BOOLEAN);

        $role->CRT_DT = !is_null($role->CRT_DT) ? $role->CRT_DT : Carbon::now();
        $role->UPD_DT = Carbon::now();
        $role->CRT_ID = !is_null($role->CRT_ID) ? $role->CRT_ID : Auth::user()->ID;
        $role->UPD_ID = Auth::user()->ID;
        $role->CRT_NAME = !is_null($role->CRT_NAME) ? $role->CRT_NAME : Auth::user()->FULL_NAME;
        $role->UPD_NAME = Auth::user()->FULL_NAME;
        return $role;
    }

    public static function mapRoleDetailFromEntity(role $role): ?RoleDetailDto {
        if ($role == null) return null;

        $roleDetail = RoleDetailDto::createEmpty();

        $roleDetail->id = $role->ID;
        $roleDetail->code = $role->CODE;
        $roleDetail->name = $role->NAME;
        $roleDetail->nameSlug = convertStrToSlug($role->NAME);
        $roleDetail->description = $role->DESCRIPTION;

        // Thông tin modire và trạng thái hoạt động
        $roleDetail->crtId = $role->CRT_ID;
        $roleDetail->crtDt = $role->CRT_DT;
        $roleDetail->updId = $role->UPD_ID;
        $roleDetail->updDt = $role->UPD_DT;
        $roleDetail->crtName = $role->CRT_NAME;
        $roleDetail->updName = $role->UPD_NAME;
        $roleDetail->status = $role->STATUS;
        if (!is_null($role->IS_ACTIVE)) $roleDetail->isActive = filter_var($role->IS_ACTIVE, FILTER_VALIDATE_BOOLEAN);

        return $roleDetail;
    }
    
    /**
     * @param Collection<Role> $listRole
     * @return Collection<RoleDetailDto>
     */
    public static function mapListRoleDetailFromPaginator(Collection $listRole): Collection {
        $listRoleDto = new Collection();
        if (empty($listRole)) return $listRoleDto;
        
        foreach ($listRole as $key => $role) {
            $listRoleDto->push(self::mapRoleDetailFromEntity($role));
        }
        return $listRoleDto;
    }
        
    private static function issetkey($array, $fieldName, $defaultValue = null) {
        return isset($array[$fieldName]) ? $array[$fieldName] : $defaultValue;
    }

}
