<?php

namespace App\Mapper;

use App\Models\ProductCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProductCategoryMapper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function mapFromArray(ProductCategory $productCategory, array $data) : ?ProductCategory {
        if ($productCategory == null) return null;

        $productCategory->ID = self::issetkey($data, 'ID');
        $productCategory->PRODUCT_ID = self::issetkey($data, 'PRODUCT_ID');
        $productCategory->CATEGORY_ID = self::issetkey($data, 'CATEGORY_ID');
        $productCategory->SORT_ORDER = self::issetkey($data, 'SORT_ORDER', 0);
        $productCategory->IS_ACTIVE = filter_var(self::issetkey($data, 'IS_ACTIVE', true), FILTER_VALIDATE_BOOLEAN);

        $productCategory->CRT_DT = !is_null($productCategory->CRT_DT) ? $productCategory->CRT_DT : Carbon::now();
        $productCategory->UPD_DT = Carbon::now();
        $productCategory->CRT_ID = !is_null($productCategory->CRT_ID) ? $productCategory->CRT_ID : Auth::user()->ID;
        $productCategory->UPD_ID = Auth::user()->ID;
        $productCategory->CRT_NAME = !is_null($productCategory->CRT_NAME) ? $productCategory->CRT_NAME : Auth::user()->FULL_NAME;
        $productCategory->UPD_NAME = Auth::user()->FULL_NAME;
        
        return $productCategory;
    }

    private static function issetkey($array, $fiedlName, $defaultValue = null) {
        return isset($array[$fiedlName]) ? $array[$fiedlName] : $defaultValue;
    }

}
