<?php

namespace App\Mapper;

use App\Dto\province\ProvinceDetailDto;
use App\Enum\AppConstant;
use App\Models\Province;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ProvinceMapper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function mapFromArray(Province $province, array $data) {
        if ($province == null) return null;

        $province->CODE = self::issetkey($data, 'CODE');
        $province->NAME = self::issetkey($data, 'NAME');
        $province->TYPE = self::issetkey($data, 'TYPE');
        $province->SORT_ORDER = self::issetkey($data, 'SORT_ORDER');
        $province->PARENT_CODE = self::issetkey($data, 'PARENT_CODE');
        $province->DESCRIPTION = self::issetkey($data, 'DESCRIPTION');
        $province->IS_ACTIVE = filter_var(self::issetkey($data, 'IS_ACTIVE', true), FILTER_VALIDATE_BOOLEAN);

        $province->STATUS = self::issetkey($data, 'STATUS', AppConstant::STATUS_USING);

        $province->CRT_DT = !is_null($province->CRT_DT) ? $province->CRT_DT : Carbon::now();
        $province->UPD_DT = Carbon::now();
        $province->CRT_ID = !is_null($province->CRT_ID) ? $province->CRT_ID : Auth::user()->ID;
        $province->UPD_ID = Auth::user()->ID;
        $province->CRT_NAME = !is_null($province->CRT_NAME) ? $province->CRT_NAME : Auth::user()->FULL_NAME;
        $province->UPD_NAME = Auth::user()->FULL_NAME;
        
        return $province;
    }

    public static function mapToDto(Province $province) : ?ProvinceDetailDto{
        if (is_null($province)) return null;

        $provinceDto = ProvinceDetailDto::createEmpty();

        $provinceDto->code = $province->CODE;
        $provinceDto->name = $province->NAME;
        $provinceDto->nameSlug = convertStrToSlug($province->NAME);
        $provinceDto->type = $province->TYPE;
        $provinceDto->sortOrder = $province->SORT_ORDER;
        $provinceDto->parentCode = $province->PARENT_CODE;
        $provinceDto->description = $province->DESCRIPTION;

        // Attribute động
        $provinceDto->attr1 = $province->ATTR1;
        $provinceDto->attr2 = $province->ATTR2;
        $provinceDto->attr3 = $province->ATTR3;
        $provinceDto->attr4 = $province->ATTR4;
        $provinceDto->attr5 = $province->ATTR5;
        $provinceDto->attr6 = $province->ATTR6;
        $provinceDto->attr7 = $province->ATTR7;
        $provinceDto->attr8 = $province->ATTR8;
        $provinceDto->attr9 = $province->ATTR9;
        $provinceDto->attr10 = $province->ATTR10;
        $provinceDto->attr11 = $province->ATTR11;
        $provinceDto->attr12 = $province->ATTR12;
        $provinceDto->attr13 = $province->ATTR13;
        $provinceDto->attr14 = $province->ATTR14;
        $provinceDto->attr15 = $province->ATTR15;
        $provinceDto->attr16 = $province->ATTR16;
        $provinceDto->attr17 = $province->ATTR17;
        $provinceDto->attr18 = $province->ATTR18;
        $provinceDto->attr19 = $province->ATTR19;
        $provinceDto->attr20 = $province->ATTR20;
        $provinceDto->attr21 = $province->ATTR21;
        $provinceDto->attr22 = $province->ATTR22;
        $provinceDto->attr23 = $province->ATTR23;
        $provinceDto->attr24 = $province->ATTR24;
        $provinceDto->attr25 = $province->ATTR25;
        $provinceDto->attr26 = $province->ATTR26;
        $provinceDto->attr27 = $province->ATTR27;
        $provinceDto->attr28 = $province->ATTR28;
        $provinceDto->attr29 = $province->ATTR29;
        $provinceDto->attr30 = $province->ATTR30;
        $provinceDto->attr31 = $province->ATTR31;
        $provinceDto->attr32 = $province->ATTR32;
        $provinceDto->attr33 = $province->ATTR33;
        $provinceDto->attr34 = $province->ATTR34;
        $provinceDto->attr35 = $province->ATTR35;
        $provinceDto->attr36 = $province->ATTR36;
        $provinceDto->attr37 = $province->ATTR37;
        $provinceDto->attr38 = $province->ATTR38;
        $provinceDto->attr39 = $province->ATTR39;
        $provinceDto->attr40 = $province->ATTR40;
        $provinceDto->attr41 = $province->ATTR41;
        $provinceDto->attr42 = $province->ATTR42;
        $provinceDto->attr43 = $province->ATTR43;
        $provinceDto->attr44 = $province->ATTR44;
        $provinceDto->attr45 = $province->ATTR45;
        $provinceDto->attr46 = $province->ATTR46;
        $provinceDto->attr47 = $province->ATTR47;
        $provinceDto->attr48 = $province->ATTR48;
        $provinceDto->attr49 = $province->ATTR49;
        $provinceDto->attr50 = $province->ATTR50;

        // Thông tin modire và trạng thái hoạt động
        $provinceDto->crtId = $province->CRT_ID;
        $provinceDto->crtDt = $province->CRT_DT;
        $provinceDto->updId = $province->UPD_ID;
        $provinceDto->updDt = $province->UPD_DT;
        $provinceDto->crtName = $province->CRT_NAME;
        $provinceDto->updName = $province->UPD_NAME;
        $provinceDto->status = $province->STATUS;
        if (!is_null($province->IS_ACTIVE)) $provinceDto->isActive = filter_var($province->IS_ACTIVE, FILTER_VALIDATE_BOOLEAN);
        
        return $provinceDto;
    }
    
    /**
     * @param Collection<Province> $listProvince
     * @return Collection<ProvinceDetailDto>
     */
    public static function maplistProvinceDto(Collection $listProvince): Collection {
        $listProvinceDto = new Collection();
        if (empty($listProvince)) return $listProvinceDto;
        
        foreach ($listProvince as $key => $province) {
            $listProvinceDto->push(self::mapToDto($province));
        }
        return $listProvinceDto;
    }

    private static function issetkey($array, $fiedlName, $defaultValue = null) {
        return isset($array[$fiedlName]) ? $array[$fiedlName] : $defaultValue;
    }

}
