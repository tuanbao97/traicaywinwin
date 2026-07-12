<?php

namespace App\Mapper;

use App\Models\NewsCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class NewsCategoryMapper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function mapFromArray(NewsCategory $newsCategory, array $data) : ?NewsCategory {
        if ($newsCategory == null) return null;

        $newsCategory->ID = self::issetkey($data, 'ID');
        $newsCategory->NEWS_ID = self::issetkey($data, 'NEWS_ID');
        $newsCategory->CATEGORY_ID = self::issetkey($data, 'CATEGORY_ID');
        $newsCategory->SORT_ORDER = self::issetkey($data, 'SORT_ORDER', 0);
        $newsCategory->IS_ACTIVE = filter_var(self::issetkey($data, 'IS_ACTIVE', true), FILTER_VALIDATE_BOOLEAN);

        $newsCategory->CRT_DT = !is_null($newsCategory->CRT_DT) ? $newsCategory->CRT_DT : Carbon::now();
        $newsCategory->UPD_DT = Carbon::now();
        $newsCategory->CRT_ID = !is_null($newsCategory->CRT_ID) ? $newsCategory->CRT_ID : Auth::user()->ID;
        $newsCategory->UPD_ID = Auth::user()->ID;
        $newsCategory->CRT_NAME = !is_null($newsCategory->CRT_NAME) ? $newsCategory->CRT_NAME : Auth::user()->FULL_NAME;
        $newsCategory->UPD_NAME = Auth::user()->FULL_NAME;
        
        return $newsCategory;
    }

    private static function issetkey($array, $fiedlName, $defaultValue = null) {
        return isset($array[$fiedlName]) ? $array[$fiedlName] : $defaultValue;
    }
} 