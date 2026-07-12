<?php

namespace App\Mapper;

use App\Models\VideoDocumentStorage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class VideoDocumentStorageMapper
{
    public static function mapFromArray(VideoDocumentStorage $videoDocumentStorage, array $data) : ?VideoDocumentStorage {
        if ($videoDocumentStorage == null) return null;

        $videoDocumentStorage->ID = self::issetkey($data, 'ID');
        $videoDocumentStorage->VIDEO_ID = self::issetkey($data, 'VIDEO_ID');
        $videoDocumentStorage->DOCUMENT_STORAGE_ID = self::issetkey($data, 'DOCUMENT_STORAGE_ID');
        $videoDocumentStorage->SORT_ORDER = self::issetkey($data, 'SORT_ORDER', 0);
        $videoDocumentStorage->IS_THUMNAIL = filter_var(self::issetkey($data, 'IS_THUMNAIL', false), FILTER_VALIDATE_BOOLEAN);
        $videoDocumentStorage->TYPE = self::issetkey($data, 'TYPE');
        $videoDocumentStorage->EXTENSION = self::issetkey($data, 'EXTENSION');
        $videoDocumentStorage->ATTR1 = self::issetkey($data, 'ATTR1');

        $videoDocumentStorage->CRT_DT = !is_null($videoDocumentStorage->CRT_DT) ? $videoDocumentStorage->CRT_DT : Carbon::now();
        $videoDocumentStorage->UPD_DT = Carbon::now();
        $videoDocumentStorage->CRT_ID = !is_null($videoDocumentStorage->CRT_ID) ? $videoDocumentStorage->CRT_ID : Auth::user()->ID;
        $videoDocumentStorage->UPD_ID = Auth::user()->ID;
        $videoDocumentStorage->CRT_NAME = !is_null($videoDocumentStorage->CRT_NAME) ? $videoDocumentStorage->CRT_NAME : Auth::user()->FULL_NAME;
        $videoDocumentStorage->UPD_NAME = Auth::user()->FULL_NAME;
        
        return $videoDocumentStorage;
    }

    private static function issetkey($array, $fiedlName, $defaultValue = null) {
        return isset($array[$fiedlName]) ? $array[$fiedlName] : $defaultValue;
    }
}
