<?php

namespace App\Mapper;

use App\Dto\district\DistrictDetailDto;
use App\Enum\AppConstant;
use App\Models\District;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class DistrictMapper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function mapFromArray(District $district, array $data) : ?District {
        if ($district == null) return null;
        
        $district->CODE = self::issetkey($data, 'CODE');
        $district->NAME = self::issetkey($data, 'NAME');
        $district->TYPE = self::issetkey($data, 'TYPE');
        $district->SORT_ORDER = self::issetkey($data, 'SORT_ORDER');
        $district->PARENT_CODE = self::issetkey($data, 'PARENT_CODE');
        $district->DESCRIPTION = self::issetkey($data, 'DESCRIPTION');
        $district->IS_ACTIVE = filter_var(self::issetkey($data, 'IS_ACTIVE', true), FILTER_VALIDATE_BOOLEAN);
        $district->PROVINCES_CODE = self::issetkey($data, 'PROVINCES_CODE', null);
        
        $district->STATUS = self::issetkey($data, 'STATUS', AppConstant::STATUS_USING);

        $district->CRT_DT = !is_null($district->CRT_DT) ? $district->CRT_DT : Carbon::now();
        $district->UPD_DT = Carbon::now();
        $district->CRT_ID = !is_null($district->CRT_ID) ? $district->CRT_ID : Auth::user()->ID;
        $district->UPD_ID = Auth::user()->ID;
        $district->CRT_NAME = !is_null($district->CRT_NAME) ? $district->CRT_NAME : Auth::user()->FULL_NAME;
        $district->UPD_NAME = Auth::user()->FULL_NAME;

        return $district;
    }

    public static function mapToDto(District $district) : ?DistrictDetailDto {
        if (is_null($district)) return null;

        $districtDto = DistrictDetailDto::createEmpty();

        $districtDto->code = $district->CODE;
        $districtDto->name = $district->NAME;
        $districtDto->nameSlug = convertStrToSlug($district->NAME);
        $districtDto->type = $district->TYPE;
        $districtDto->sortOrder = $district->SORT_ORDER;
        $districtDto->parentCode = $district->PARENT_CODE;
        $districtDto->description = $district->DESCRIPTION;

        // Attribute động
        $districtDto->attr1 = $district->ATTR1;
        $districtDto->attr2 = $district->ATTR2;
        $districtDto->attr3 = $district->ATTR3;
        $districtDto->attr4 = $district->ATTR4;
        $districtDto->attr5 = $district->ATTR5;
        $districtDto->attr6 = $district->ATTR6;
        $districtDto->attr7 = $district->ATTR7;
        $districtDto->attr8 = $district->ATTR8;
        $districtDto->attr9 = $district->ATTR9;
        $districtDto->attr10 = $district->ATTR10;
        $districtDto->attr11 = $district->ATTR11;
        $districtDto->attr12 = $district->ATTR12;
        $districtDto->attr13 = $district->ATTR13;
        $districtDto->attr14 = $district->ATTR14;
        $districtDto->attr15 = $district->ATTR15;
        $districtDto->attr16 = $district->ATTR16;
        $districtDto->attr17 = $district->ATTR17;
        $districtDto->attr18 = $district->ATTR18;
        $districtDto->attr19 = $district->ATTR19;
        $districtDto->attr20 = $district->ATTR20;
        $districtDto->attr21 = $district->ATTR21;
        $districtDto->attr22 = $district->ATTR22;
        $districtDto->attr23 = $district->ATTR23;
        $districtDto->attr24 = $district->ATTR24;
        $districtDto->attr25 = $district->ATTR25;
        $districtDto->attr26 = $district->ATTR26;
        $districtDto->attr27 = $district->ATTR27;
        $districtDto->attr28 = $district->ATTR28;
        $districtDto->attr29 = $district->ATTR29;
        $districtDto->attr30 = $district->ATTR30;
        $districtDto->attr31 = $district->ATTR31;
        $districtDto->attr32 = $district->ATTR32;
        $districtDto->attr33 = $district->ATTR33;
        $districtDto->attr34 = $district->ATTR34;
        $districtDto->attr35 = $district->ATTR35;
        $districtDto->attr36 = $district->ATTR36;
        $districtDto->attr37 = $district->ATTR37;
        $districtDto->attr38 = $district->ATTR38;
        $districtDto->attr39 = $district->ATTR39;
        $districtDto->attr40 = $district->ATTR40;
        $districtDto->attr41 = $district->ATTR41;
        $districtDto->attr42 = $district->ATTR42;
        $districtDto->attr43 = $district->ATTR43;
        $districtDto->attr44 = $district->ATTR44;
        $districtDto->attr45 = $district->ATTR45;
        $districtDto->attr46 = $district->ATTR46;
        $districtDto->attr47 = $district->ATTR47;
        $districtDto->attr48 = $district->ATTR48;
        $districtDto->attr49 = $district->ATTR49;
        $districtDto->attr50 = $district->ATTR50;

        // Thông tin modire và trạng thái hoạt động
        $districtDto->crtId = $district->CRT_ID;
        $districtDto->crtDt = $district->CRT_DT;
        $districtDto->updId = $district->UPD_ID;
        $districtDto->updDt = $district->UPD_DT;
        $districtDto->crtName = $district->CRT_NAME;
        $districtDto->updName = $district->UPD_NAME;
        $districtDto->status = $district->STATUS;
        if (!is_null($district->IS_ACTIVE)) $districtDto->isActive = filter_var($district->IS_ACTIVE, FILTER_VALIDATE_BOOLEAN);
        
        return $districtDto;
    }
    
    /**
     * @param Collection<district> $listDistrict
     * @return Collection<DistrictDetailDto>
     */
    public static function mapListDistrictDto(Collection $listDistrict): Collection {
        $listDistrictDto = new Collection();
        if (empty($listDistrict)) return $listDistrict;
        
        foreach ($listDistrict as $key => $district) {
            $listDistrictDto->push(self::mapToDto($district));
        }
        return $listDistrictDto;
    }
    
    private static function issetkey($array, $fieldName, $defaultValue = null) {
        return isset($array[$fieldName]) ? $array[$fieldName] : $defaultValue;
    }
    
}
