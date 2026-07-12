<?php

namespace App\Mapper;

use App\Models\CategoryPDocumentStorage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CategoryPDocumentStorageMapper
{
    public static function mapFromArray(CategoryPDocumentStorage $categoryPDocumentStorage, array $data) : ?CategoryPDocumentStorage {
        if ($categoryPDocumentStorage == null) return null;

        $categoryPDocumentStorage->ID = self::issetkey($data, 'ID');
        $categoryPDocumentStorage->CATEGORY_P_ID = self::issetkey($data, 'CATEGORY_P_ID');
        $categoryPDocumentStorage->DOCUMENT_STORAGE_ID = self::issetkey($data, 'DOCUMENT_STORAGE_ID');
        $categoryPDocumentStorage->SORT_ORDER = self::issetkey($data, 'SORT_ORDER', 0);
        $categoryPDocumentStorage->IS_THUMNAIL = filter_var(self::issetkey($data, 'IS_THUMNAIL', false), FILTER_VALIDATE_BOOLEAN);
        $categoryPDocumentStorage->TYPE = self::issetkey($data, 'TYPE');
        $categoryPDocumentStorage->EXTENSION = self::issetkey($data, 'EXTENSION');
        $categoryPDocumentStorage->ATTR1 = self::issetkey($data, 'ATTR1');
        $categoryPDocumentStorage->ATTR2 = self::issetkey($data, 'ATTR2');

        $categoryPDocumentStorage->CRT_DT = !is_null($categoryPDocumentStorage->CRT_DT) ? $categoryPDocumentStorage->CRT_DT : Carbon::now();
        $categoryPDocumentStorage->UPD_DT = Carbon::now();
        $categoryPDocumentStorage->CRT_ID = !is_null($categoryPDocumentStorage->CRT_ID) ? $categoryPDocumentStorage->CRT_ID : Auth::user()->ID;
        $categoryPDocumentStorage->UPD_ID = Auth::user()->ID;
        $categoryPDocumentStorage->CRT_NAME = !is_null($categoryPDocumentStorage->CRT_NAME) ? $categoryPDocumentStorage->CRT_NAME : Auth::user()->FULL_NAME;
        $categoryPDocumentStorage->UPD_NAME = Auth::user()->FULL_NAME;
        
        return $categoryPDocumentStorage;
    }

    private static function issetkey($array, $fiedlName, $defaultValue = null) {
        return isset($array[$fiedlName]) ? $array[$fiedlName] : $defaultValue;
    }
}
