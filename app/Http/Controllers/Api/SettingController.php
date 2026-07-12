<?php

namespace App\Http\Controllers\Api;

use App\Enum\SettingEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\setting\SettingDetailRequest;
use App\Http\Requests\setting\SettingListRequest;
use App\Http\Requests\setting\SettingWebSaveRequest;
use App\Service\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    // Inject beans
    private SettingService $settingService;

    public function __construct(SettingService $settingService) {
        $this->settingService = $settingService;
    }

    public function getDetailSetting(string $code, SettingDetailRequest $request) {
        return $this->settingService->getDetailSetting($code, $request);
    }


    public function getListSetting(SettingListRequest $request) {
        $type = $request->input('TYPE');
        return $this->settingService->getListSettingByType(SettingEnum::fromName($type), $request);
    }

    public function saveSettingWeb(SettingWebSaveRequest $request) {
        evictCacheDataFrontEnd();
        return $this->settingService->saveSettingWeb($request);
    }
}
