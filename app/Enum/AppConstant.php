<?php

namespace App\Enum;

use Illuminate\Validation\Rules\Enum;

final class AppConstant extends Enum
{
    const GRANT_TYPES = [
        'PASSWORD' => 'password', 
        'REFRESH_TOKEN' => 'refresh_token',
        'CLIENT_CREDENTIALS' => 'client_credentials',
        'PERSONAL_ACCESS' => 'personal_access'
    ];

    const PREFIX_API = [
        'API' => 'api',
        'API_PUBLIC' => 'api/public'
    ];

    const CACHE_TAG_DATA_UI_FRONTEND = 'CACHE_TAG_DATA_UI_FRONTEND';
    const CACHE_PREFIX_DATA_UI_FRONTEND = 'CACHE_DATA_UI_FRONTEND_';

    const COOKIE_SKIP_COUNT_VIEW_WEBSITE = 'COOKIE_SKIP_COUNT_VIEW_WEBSITE';
    
    const STATUS_SUCCESS = true;
    const STATUS_FAILURE = false;
    const STATUS_DETAIL_FAILURE = 'Failure';
    
    const STATUS_USING = 'USING';
    const STATUS_DELETED = 'DELETED';
    const STATUS_SOLD = 'SOLD';

    const DANH_SACH_KICH_THUOC_HINH_ANH = ['1x1', '3x2', '4x3', '5x3', '16x9', 'raw'];
    const DANH_SACH_BO_LOC_TIM_KIEM = ['default', 'gia-tang', 'gia-giam', 'a-z', 'z-a', 'cu-den-moi', 'moi-den-cu'];

    const TYPE_PRODUCT_COMMON = 'PRODUCT_COMMON';
    const PATH_CHI_TIET_PRODUCT_COMMON = 'UI-BACKEND/admin/san-pham/common/san-pham';

    const TYPE_NEWS_COMMON = 'NEWS_COMMON';
    const PATH_CHI_TIET_NEWS_COMMON = 'UI-BACKEND/admin/tin-tuc/common/tin-tuc';

    // Danh sách hướng
    const HUONG_DAT = ['DONG','TAY','NAM','BAC','DONG_BAC','DONG_NAM','TAY_BAC','TAY_NAM'];



    public function __construct()
    {
        //
    }
}
