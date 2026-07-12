<?php

namespace App\Mapper;

use App\Models\NewsDocumentStorage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class NewsDocumentStorageMapper
{
    public static function mapFromArray(NewsDocumentStorage $newsDocumentStorage, array $data) : ?NewsDocumentStorage {
        if ($newsDocumentStorage == null) return null;

        $newsDocumentStorage->ID = self::issetkey($data, 'ID');
        $newsDocumentStorage->NEWS_ID = self::issetkey($data, 'NEWS_ID');
        $newsDocumentStorage->DOCUMENT_STORAGE_ID = self::issetkey($data, 'DOCUMENT_STORAGE_ID');
        $newsDocumentStorage->SORT_ORDER = self::issetkey($data, 'SORT_ORDER', 0);
        $newsDocumentStorage->IS_THUMNAIL = filter_var(self::issetkey($data, 'IS_THUMNAIL', false), FILTER_VALIDATE_BOOLEAN);
        $newsDocumentStorage->TYPE = self::issetkey($data, 'TYPE');
        $newsDocumentStorage->EXTENSION = self::issetkey($data, 'EXTENSION');
        $newsDocumentStorage->ATTR1 = self::issetkey($data, 'ATTR1');

        $newsDocumentStorage->CRT_DT = !is_null($newsDocumentStorage->CRT_DT) ? $newsDocumentStorage->CRT_DT : Carbon::now();
        $newsDocumentStorage->UPD_DT = Carbon::now();
        $newsDocumentStorage->CRT_ID = !is_null($newsDocumentStorage->CRT_ID) ? $newsDocumentStorage->CRT_ID : Auth::user()->ID;
        $newsDocumentStorage->UPD_ID = Auth::user()->ID;
        $newsDocumentStorage->CRT_NAME = !is_null($newsDocumentStorage->CRT_NAME) ? $newsDocumentStorage->CRT_NAME : Auth::user()->FULL_NAME;
        $newsDocumentStorage->UPD_NAME = Auth::user()->FULL_NAME;
        
        return $newsDocumentStorage;
    }

    private static function issetkey($array, $fiedlName, $defaultValue = null) {
        return isset($array[$fiedlName]) ? $array[$fiedlName] : $defaultValue;
    }
} 