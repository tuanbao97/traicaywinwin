<?php

namespace App\Service;

use App\Enum\SettingEnum;
use App\Models\Setting;
use Illuminate\Http\Request;

interface SettingService
{
    public function getOrNewSetting(string $code) : ?Setting;

    public function getDetailSetting(string $code, Request $request);


    public function getListSettingByType(SettingEnum $type, Request $request);

    public function saveSettingWeb(Request $request);
    
}
