<?php

namespace App\Mapper;

use App\Models\CategoryNDocumentStorage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CategoryNDocumentStorageMapper
{
    public static function mapFromArray(CategoryNDocumentStorage $categoryNDocumentStorage, array $data) : ?CategoryNDocumentStorage {
        if ($categoryNDocumentStorage == null) return null;

        $categoryNDocumentStorage->ID = self::issetkey($data, 'ID');
        $categoryNDocumentStorage->CATEGORY_N_ID = self::issetkey($data, 'CATEGORY_N_ID');
        $categoryNDocumentStorage->DOCUMENT_STORAGE_ID = self::issetkey($data, 'DOCUMENT_STORAGE_ID');
        $categoryNDocumentStorage->SORT_ORDER = self::issetkey($data, 'SORT_ORDER', 0);
        $categoryNDocumentStorage->IS_THUMNAIL = filter_var(self::issetkey($data, 'IS_THUMNAIL', false), FILTER_VALIDATE_BOOLEAN);
        $categoryNDocumentStorage->TYPE = self::issetkey($data, 'TYPE');
        $categoryNDocumentStorage->EXTENSION = self::issetkey($data, 'EXTENSION');
        $categoryNDocumentStorage->ATTR1 = self::issetkey($data, 'ATTR1');
        $categoryNDocumentStorage->ATTR2 = self::issetkey($data, 'ATTR2');

        $categoryNDocumentStorage->CRT_DT = !is_null($categoryNDocumentStorage->CRT_DT) ? $categoryNDocumentStorage->CRT_DT : Carbon::now();
        $categoryNDocumentStorage->UPD_DT = Carbon::now();
        $categoryNDocumentStorage->CRT_ID = !is_null($categoryNDocumentStorage->CRT_ID) ? $categoryNDocumentStorage->CRT_ID : Auth::user()->ID;
        $categoryNDocumentStorage->UPD_ID = Auth::user()->ID;
        $categoryNDocumentStorage->CRT_NAME = !is_null($categoryNDocumentStorage->CRT_NAME) ? $categoryNDocumentStorage->CRT_NAME : Auth::user()->FULL_NAME;
        $categoryNDocumentStorage->UPD_NAME = Auth::user()->FULL_NAME;
        
        return $categoryNDocumentStorage;
    }

    private static function issetkey($array, $fiedlName, $defaultValue = null) {
        return isset($array[$fiedlName]) ? $array[$fiedlName] : $defaultValue;
    }
}
