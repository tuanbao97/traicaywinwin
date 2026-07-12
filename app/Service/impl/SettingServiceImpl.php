<?php

namespace App\Service\impl;

use App\Dto\response\ApiResponseDto;
use App\Enum\AppConstant;
use App\Enum\SettingEnum;
use App\Mapper\DocumentStorageMapper;
use App\Mapper\SettingMapper;
use App\Models\DocumentStorage;
use App\Models\Setting;
use App\Repository\SettingRepository;
use App\Service\DocumentStorageService;
use App\Service\SettingService;
use App\Utils\PaginationUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingServiceImpl implements SettingService
{
    // Inject beans
    private SettingRepository $settingRepository;

    private DocumentStorageService $documentStorageService;

    /**
     * Create a new class instance.
     */
    public function __construct(SettingRepository $settingRepository, DocumentStorageService $documentStorageService)
    {
        $this->settingRepository = $settingRepository;
        $this->documentStorageService = $documentStorageService;
    }

    public function getOrNewSetting(string $code) : Setting {
        $setting = $this->settingRepository->getSettingDetail($code);
        if (! is_null($setting)) {
            return $setting;
        }

        $setting = new Setting();
        $setting->CODE = $code;
        $setting->STATUS = AppConstant::STATUS_USING;

        if (preg_match('/^SETTING_COUNT_VIEW_DAY_(.+)$/', $code, $matches)) {
            $day = $matches[1];
            $setting->NAME = sprintf(SettingEnum::SETTING_COUNT_VIEW_DAY->description(), $day);
            $setting->DESCRIPTION = $setting->NAME;
            $setting->UNIT = SettingEnum::SETTING_COUNT_VIEW_DAY->unit();
            $setting->TYPE = SettingEnum::SETTING_COUNT_VIEW_DAY->type();
            $setting->VALUE = 0;
        }

        return $setting;
    }

    public function getDetailSetting(string $code, Request $request) {
        $setting = $this->settingRepository->getSettingDetail($code);
        $settingDetailDto = SettingMapper::mapSettingDetailDtoFromEntity($setting);

        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Truy vấn thành công.'
                , [
                    camelToSnakeUpper(class_basename(Setting::class)) => $settingDetailDto
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }


    public function getListSettingByType(SettingEnum $type, Request $request) {
        // Get input
        $page = $request->query('PAGE', 1);
        $perPage = $request->query('PER_PAGE', 10);

        $isGetAllElements = filter_var($request->query('IS_GET_ALL_ELEMENTS', false), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        if ($isGetAllElements === true) {
            $perPage = 2147483647;  
        }
        $tuKhoa = $request->input('TU_KHOA', null);

        // Retrieve database
        $resultPagination = $this->settingRepository->getListSettingByType($type, $tuKhoa, $page, $perPage);

        if (!is_null($resultPagination) && !$resultPagination->getCollection()->isEmpty()) {
            foreach ($resultPagination->getCollection() as $index => $setting) {
                if (in_array($setting->CODE, 
                        [SettingEnum::SETTING_GIOI_THIEU_CUA_HANG->name
                        , SettingEnum::SETTING_CAM_KET_BAN_HANG->name
                    ])
                ) {
                    $setting->VALUE = convertMediaPathsToAbsolute($setting->VALUE);
                }
                
            }
        }
        
        // Custom response pagination
        $customResponsePagination = PaginationUtils::pagination($resultPagination);
        
        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Truy vấn thành công.'
                , [
                    camelToSnakeUpper(class_basename(Setting::class)) => $customResponsePagination
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }
    
    public function saveSettingWeb(Request $request) {
        // Bắt đầu một Transaction
        DB::beginTransaction();

        // Danh sách hotline
        // Xóa tất cả trước
        Setting::where([
            ['CODE', 'LIKE', 'SETTING_HOTLINE_TYPE_%'],
        ])->delete();
        $danhSachHotline = $request->input('SETTING_DANH_SACH_HOTLINE');
        if (!is_null($danhSachHotline) && count($danhSachHotline) > 0) {
            foreach ($danhSachHotline as $index => $itemHotline) {
                $itemHotline = (object) $itemHotline;
                
                $settingHotline = new Setting();
                $settingHotline->CODE = 'SETTING_HOTLINE_TYPE_' . $itemHotline->LOAI . '_' . $index;
                $settingHotline->VALUE = ($itemHotline->LOAI . '|' . $itemHotline->SDT . '|' . $itemHotline->TEN_CHU_SDT);
                $settingHotline->ORDER = $index + 1;
                $settingHotline->NAME = 'SETTING_HOTLINE_TYPE_' . $itemHotline->LOAI;
                $settingHotline->DESCRIPTION = SettingEnum::SETTING_HOTLINE->description();
                $settingHotline->UNIT = SettingEnum::SETTING_HOTLINE->unit();
                $settingHotline->TYPE = SettingEnum::SETTING_HOTLINE->type();
                $settingHotline->save();
            }
        }

        foreach ($request->all() as $key => $value) {
            // Bỏ qua nếu key là SETTING_DANH_SACH_HOTLINE hoặc là mảng
            if ($key === 'SETTING_DANH_SACH_HOTLINE' || is_array($value)) {
                continue;
            }

            $setting = self::getOrNewSetting(SettingEnum::fromName($key)?->name ?? $key);
            $setting->VALUE = $value;
            $setting->NAME = SettingEnum::fromName($key)->description();
            $setting->DESCRIPTION = SettingEnum::fromName($key)->description();
            $setting->UNIT = SettingEnum::fromName($key)->unit();
            $setting->TYPE = SettingEnum::fromName($key)->type();
            $setting->save();
        }

        // Nếu mọi thứ thành công, commit Transaction
        DB::commit();
        return response()->json(
            new ApiResponseDto(
                AppConstant::STATUS_SUCCESS,
                'Lưu thành công.',
                [
                    camelToSnakeUpper(class_basename(Setting::class))
                        => null
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }

    public function getDetailSettingCountView(string $code, Request $request) {
        $setting = $this->settingRepository->getSettingDetail($code);
        
        if (is_null($setting)) {
            return response()->json(
                new ApiResponseDto(AppConstant::STATUS_FAILURE
                    , 'Không tìm thấy setting.'
                    , [
                        camelToSnakeUpper(class_basename(Setting::class)) => null
                    ]
                )
            )->setStatusCode(JsonResponse::HTTP_NOT_FOUND);
        }

        // Parse ATTR1 và ATTR2 từ JSON string thành array
        $attr1Array = [];
        if (!empty($setting->ATTR1)) {
            try {
                $attr1Array = json_decode($setting->ATTR1, true);
                if (!is_array($attr1Array)) {
                    $attr1Array = [];
                }
            } catch (\Exception $e) {
                $attr1Array = [];
            }
        }

        $attr2Array = [];
        if (!empty($setting->ATTR2)) {
            try {
                $attr2Array = json_decode($setting->ATTR2, true);
                if (!is_array($attr2Array)) {
                    $attr2Array = [];
                }
            } catch (\Exception $e) {
                $attr2Array = [];
            }
        }

        // Tạo custom response với ATTR đã được parse
        $response = [
            'CODE' => $setting->CODE,
            'TEN' => $setting->NAME,
            'GIA_TRI' => $setting->VALUE,
            'DON_VI' => $setting->UNIT,
            'MO_TA' => $setting->DESCRIPTION,
            'ATTR1' => $attr1Array,  // Array
            'ATTR2' => $attr2Array,  // Array
            'CRT_DT' => $setting->CRT_DT,
            'CRT_ID' => $setting->CRT_ID,
            'UPD_DT' => $setting->UPD_DT,
            'UPD_ID' => $setting->UPD_ID,
            'CRT_NAME' => $setting->CRT_NAME,
            'UPD_NAME' => $setting->UPD_NAME,
            'TRANG_THAI' => $setting->STATUS,
            'TRANG_THAI_HOAT_DONG' => $setting->IS_ACTIVE
        ];

        return response()->json(
            new ApiResponseDto(AppConstant::STATUS_SUCCESS
                , 'Truy vấn thành công.'
                , [
                    camelToSnakeUpper(class_basename(Setting::class)) => $response
                ]
            )
        )->setStatusCode(JsonResponse::HTTP_OK);
    }
    
}
