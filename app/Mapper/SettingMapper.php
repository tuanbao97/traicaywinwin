<?php

namespace App\Mapper;

use App\Dto\setting\SettingDetailDto;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SettingMapper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function mapFromArray(Setting $setting, array $data) : ?Setting {
        if (is_null($setting)) return null;

        $setting->CODE = self::issetKey($data, 'CODE');
        $setting->NAME = self::issetKey($data, 'NAME');
        $setting->VALUE = self::issetKey($data, 'VALUE');
        $setting->UNIT = self::issetKey($data, 'UNIT');
        $setting->DESCRIPTION = self::issetkey($data, 'DESCRIPTION');
        $setting->IS_ACTIVE = filter_var(self::issetkey($data, 'IS_ACTIVE', true), FILTER_VALIDATE_BOOLEAN);

        $setting->CRT_DT = !is_null($setting->CRT_DT) ? $setting->CRT_DT : Carbon::now();
        $setting->UPD_DT = Carbon::now();
        $setting->CRT_ID = !is_null($setting->CRT_ID) ? $setting->CRT_ID : Auth::user()->ID;
        $setting->UPD_ID = Auth::user()->ID;
        $setting->CRT_NAME = !is_null($setting->CRT_NAME) ? $setting->CRT_NAME : Auth::user()->FULL_NAME;
        $setting->UPD_NAME = Auth::user()->FULL_NAME;
        
        return $setting;
    }

    public static function mapSettingDetailDtoFromEntity(?Setting $setting) : ?SettingDetailDto {
        if (is_null($setting)) return null;

        $settingDetailDto = SettingDetailDto::createEmpty();
        $settingDetailDto->code = $setting->CODE;
        $settingDetailDto->name = $setting->NAME;
        $settingDetailDto->value = $setting->VALUE;
        $settingDetailDto->nameSlug = convertStrToSlug($setting->NAME);
        $settingDetailDto->unit = $setting->UNIT;
        $settingDetailDto->description = $setting->DESCRIPTION;

        $settingDetailDto->crtId = $setting->CRT_ID;
        $settingDetailDto->crtDt = $setting->CRT_DT;
        $settingDetailDto->updId = $setting->UPD_ID;
        $settingDetailDto->updDt = $setting->UPD_DT;
        $settingDetailDto->crtName = $setting->CRT_NAME;
        $settingDetailDto->updName = $setting->UPD_NAME;
        $settingDetailDto->status = $setting->STATUS;
        if (!is_null($setting->IS_ACTIVE)) $settingDetailDto->isActive = filter_var($setting->IS_ACTIVE, FILTER_VALIDATE_BOOLEAN);

        // Map ATTR1 đến ATTR10
        $settingDetailDto->attr1 = $setting->ATTR1;
        $settingDetailDto->attr2 = $setting->ATTR2;
        $settingDetailDto->attr3 = $setting->ATTR3;
        $settingDetailDto->attr4 = $setting->ATTR4;
        $settingDetailDto->attr5 = $setting->ATTR5;
        $settingDetailDto->attr6 = $setting->ATTR6;
        $settingDetailDto->attr7 = $setting->ATTR7;
        $settingDetailDto->attr8 = $setting->ATTR8;
        $settingDetailDto->attr9 = $setting->ATTR9;
        $settingDetailDto->attr10 = $setting->ATTR10;

        return $settingDetailDto;
    }
    
    public static function issetKey($array, $fieldName, $defaultValue = null) {
        return isset($array[$fieldName]) ? $array[$fieldName] : $defaultValue;
    }

}
