<?php

namespace App\Mapper;

use App\Models\ProductDocumentStorage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProductDocumentStorageMapper
{
    public static function mapFromArray(ProductDocumentStorage $productDocumentStorage, array $data) : ?ProductDocumentStorage {
        if ($productDocumentStorage == null) return null;

        $productDocumentStorage->ID = self::issetkey($data, 'ID');
        $productDocumentStorage->PRODUCT_ID = self::issetkey($data, 'PRODUCT_ID');
        $productDocumentStorage->DOCUMENT_STORAGE_ID = self::issetkey($data, 'DOCUMENT_STORAGE_ID');
        $productDocumentStorage->SORT_ORDER = self::issetkey($data, 'SORT_ORDER', 0);
        $productDocumentStorage->IS_THUMNAIL = filter_var(self::issetkey($data, 'IS_THUMNAIL', false), FILTER_VALIDATE_BOOLEAN);
        $productDocumentStorage->TYPE = self::issetkey($data, 'TYPE');
        $productDocumentStorage->EXTENSION = self::issetkey($data, 'EXTENSION');
        $productDocumentStorage->ATTR1 = self::issetkey($data, 'ATTR1');

        $productDocumentStorage->CRT_DT = !is_null($productDocumentStorage->CRT_DT) ? $productDocumentStorage->CRT_DT : Carbon::now();
        $productDocumentStorage->UPD_DT = Carbon::now();
        $productDocumentStorage->CRT_ID = !is_null($productDocumentStorage->CRT_ID) ? $productDocumentStorage->CRT_ID : Auth::user()->ID;
        $productDocumentStorage->UPD_ID = Auth::user()->ID;
        $productDocumentStorage->CRT_NAME = !is_null($productDocumentStorage->CRT_NAME) ? $productDocumentStorage->CRT_NAME : Auth::user()->FULL_NAME;
        $productDocumentStorage->UPD_NAME = Auth::user()->FULL_NAME;
        
        return $productDocumentStorage;
    }

    private static function issetkey($array, $fiedlName, $defaultValue = null) {
        return isset($array[$fiedlName]) ? $array[$fiedlName] : $defaultValue;
    }
}
