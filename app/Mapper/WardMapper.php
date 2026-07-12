<?php

namespace App\Mapper;

use App\Dto\ward\WardDetailDto;
use App\Enum\AppConstant;
use App\Models\Ward;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class WardMapper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function mapFromArray(Ward $ward, array $data) : ?Ward {
        if ($ward == null) return null;
        
        $ward->CODE = self::issetkey($data, 'CODE');
        $ward->NAME = self::issetkey($data, 'NAME');
        $ward->TYPE = self::issetkey($data, 'TYPE');
        $ward->SORT_ORDER = self::issetkey($data, 'SORT_ORDER');
        $ward->PARENT_CODE = self::issetkey($data, 'PARENT_CODE');
        $ward->DESCRIPTION = self::issetkey($data, 'DESCRIPTION');
        $ward->IS_ACTIVE = filter_var(self::issetkey($data, 'IS_ACTIVE', true), FILTER_VALIDATE_BOOLEAN);
        $ward->DISTRICT_CODE = self::issetkey($data, 'DISTRICT_CODE', null);
        
        $ward->STATUS = self::issetkey($data, 'STATUS', AppConstant::STATUS_USING);
        
        $ward->CRT_DT = !is_null($ward->CRT_DT) ? $ward->CRT_DT : Carbon::now();
        $ward->UPD_DT = Carbon::now();
        $ward->CRT_ID = !is_null($ward->CRT_ID) ? $ward->CRT_ID : Auth::user()->ID;
        $ward->UPD_ID = Auth::user()->ID;
        $ward->CRT_NAME = !is_null($ward->CRT_NAME) ? $ward->CRT_NAME : Auth::user()->FULL_NAME;
        $ward->UPD_NAME = Auth::user()->FULL_NAME;

        return $ward;
    }
    
    public static function mapToDto(Ward $ward) : ?WardDetailDto {
        if (is_null($ward)) return null;

        $wardDto = WardDetailDto::createEmpty();

        $wardDto->code = $ward->CODE;
        $wardDto->name = $ward->NAME;
        $wardDto->nameSlug = convertStrToSlug($ward->NAME);
        $wardDto->type = $ward->TYPE;
        $wardDto->sortOrder = $ward->SORT_ORDER;
        $wardDto->parentCode = $ward->PARENT_CODE;
        $wardDto->description = $ward->DESCRIPTION;

        // Attribute động
        $wardDto->attr1 = $ward->ATTR1;
        $wardDto->attr2 = $ward->ATTR2;
        $wardDto->attr3 = $ward->ATTR3;
        $wardDto->attr4 = $ward->ATTR4;
        $wardDto->attr5 = $ward->ATTR5;
        $wardDto->attr6 = $ward->ATTR6;
        $wardDto->attr7 = $ward->ATTR7;
        $wardDto->attr8 = $ward->ATTR8;
        $wardDto->attr9 = $ward->ATTR9;
        $wardDto->attr10 = $ward->ATTR10;
        $wardDto->attr11 = $ward->ATTR11;
        $wardDto->attr12 = $ward->ATTR12;
        $wardDto->attr13 = $ward->ATTR13;
        $wardDto->attr14 = $ward->ATTR14;
        $wardDto->attr15 = $ward->ATTR15;
        $wardDto->attr16 = $ward->ATTR16;
        $wardDto->attr17 = $ward->ATTR17;
        $wardDto->attr18 = $ward->ATTR18;
        $wardDto->attr19 = $ward->ATTR19;
        $wardDto->attr20 = $ward->ATTR20;
        $wardDto->attr21 = $ward->ATTR21;
        $wardDto->attr22 = $ward->ATTR22;
        $wardDto->attr23 = $ward->ATTR23;
        $wardDto->attr24 = $ward->ATTR24;
        $wardDto->attr25 = $ward->ATTR25;
        $wardDto->attr26 = $ward->ATTR26;
        $wardDto->attr27 = $ward->ATTR27;
        $wardDto->attr28 = $ward->ATTR28;
        $wardDto->attr29 = $ward->ATTR29;
        $wardDto->attr30 = $ward->ATTR30;
        $wardDto->attr31 = $ward->ATTR31;
        $wardDto->attr32 = $ward->ATTR32;
        $wardDto->attr33 = $ward->ATTR33;
        $wardDto->attr34 = $ward->ATTR34;
        $wardDto->attr35 = $ward->ATTR35;
        $wardDto->attr36 = $ward->ATTR36;
        $wardDto->attr37 = $ward->ATTR37;
        $wardDto->attr38 = $ward->ATTR38;
        $wardDto->attr39 = $ward->ATTR39;
        $wardDto->attr40 = $ward->ATTR40;
        $wardDto->attr41 = $ward->ATTR41;
        $wardDto->attr42 = $ward->ATTR42;
        $wardDto->attr43 = $ward->ATTR43;
        $wardDto->attr44 = $ward->ATTR44;
        $wardDto->attr45 = $ward->ATTR45;
        $wardDto->attr46 = $ward->ATTR46;
        $wardDto->attr47 = $ward->ATTR47;
        $wardDto->attr48 = $ward->ATTR48;
        $wardDto->attr49 = $ward->ATTR49;
        $wardDto->attr50 = $ward->ATTR50;

        // Thông tin modire và trạng thái hoạt động
        $wardDto->crtId = $ward->CRT_ID;
        $wardDto->crtDt = $ward->CRT_DT;
        $wardDto->updId = $ward->UPD_ID;
        $wardDto->updDt = $ward->UPD_DT;
        $wardDto->crtName = $ward->CRT_NAME;
        $wardDto->updName = $ward->UPD_NAME;
        $wardDto->status = $ward->STATUS;
        if (!is_null($ward->IS_ACTIVE)) $wardDto->isActive = filter_var($ward->IS_ACTIVE, FILTER_VALIDATE_BOOLEAN);
        
        return $wardDto;
    }
    
    /**
     * @param Collection<Ward> $listWard
     * @return Collection<WardDetailDto>
     */
    public static function mapListWardDto(Collection $listWard): Collection {
        $listWardDto = new Collection();
        if (empty($listWard)) return $listWard;
        
        foreach ($listWard as $key => $district) {
            $listWardDto->push(self::mapToDto($district));
        }
        return $listWardDto;
    }

    private static function issetkey($array, $fiedlName, $defaultValue = null) {
        return isset($array[$fiedlName]) ? $array[$fiedlName] : $defaultValue;
    }
}
