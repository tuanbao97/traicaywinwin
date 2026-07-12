<?php

namespace App\Mapper;

use App\Dto\documentStorage\DocumentStorageDetailDto;
use App\Dto\documentStorage\VideoDetailDto;
use App\Models\DocumentStorage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DocumentStorageMapper
{

    public static function mapFromArray(DocumentStorage $documentStorage, array $data) : ?DocumentStorage {
        if ($documentStorage == null) return null;

        $documentStorage->ID = self::issetkey($data, 'ID');
        $documentStorage->NAME = self::issetkey($data, 'FILE_NAME_HASH');
        $documentStorage->ORIGINAL_NAME = self::issetkey($data, 'FILE_ORIGINAL_NAME');
        $documentStorage->EXTENSION = self::issetkey($data, 'FILE_EXTENSION');
        $documentStorage->PATH = self::issetkey($data, 'FILE_PATH');
        $documentStorage->DIRECTORY = self::issetkey($data, 'FILE_DIRECTORY');
        $documentStorage->SIZE = self::issetkey($data, 'FILE_SIZE', 0);
        $documentStorage->MD5 = self::issetkey($data, 'FILE_MD5');
        $documentStorage->TYPE_FILE = self::issetkey($data, 'TYPE_FILE');
        $documentStorage->DESCRIPTION = self::issetkey($data, 'DESCRIPTION');

        $documentStorage->CRT_DT = !is_null($documentStorage->CRT_DT) ? $documentStorage->CRT_DT : Carbon::now();
        $documentStorage->UPD_DT = Carbon::now();
        $documentStorage->CRT_ID = !is_null($documentStorage->CRT_ID) ? $documentStorage->CRT_ID : Auth::user()->ID;
        $documentStorage->UPD_ID = Auth::user()->ID;
        $documentStorage->CRT_NAME = !is_null($documentStorage->CRT_NAME) ? $documentStorage->CRT_NAME : Auth::user()->FULL_NAME;
        $documentStorage->UPD_NAME = Auth::user()->FULL_NAME;

        return $documentStorage;
    }

    public static function mapDocumentStorageDetailFromEntity($documentStorage): ?DocumentStorageDetailDto {
        if ($documentStorage == null) return null;

        $documentStorageDto = DocumentStorageDetailDto::createEmpty();
        // Thông tin document storage
        $documentStorageDto->id = $documentStorage->ID;
        $documentStorageDto->name = $documentStorage->NAME;
        $documentStorageDto->originalName = $documentStorage->ORIGINAL_NAME;
        $documentStorageDto->extension = $documentStorage->EXTENSION;
        $documentStorageDto->path = $documentStorage->PATH;
        $documentStorageDto->directory = $documentStorage->DIRECTORY;
        $documentStorageDto->size = $documentStorage->SIZE;
        $documentStorageDto->md5 = $documentStorage->MD5;
        $documentStorageDto->typeFile = $documentStorage->TYPE_FILE;
        $documentStorageDto->description = $documentStorage->DESCRIPTION;

        // Thông tin modire và trạng thái hoạt động
        $documentStorageDto->crtId = $documentStorage->CRT_ID;
        $documentStorageDto->crtDt = $documentStorage->CRT_DT;
        $documentStorageDto->updId = $documentStorage->UPD_ID;
        $documentStorageDto->updDt = $documentStorage->UPD_DT;
        if (!is_null($documentStorage->IS_ACTIVE)) $documentStorageDto->isActive = filter_var($documentStorage->IS_ACTIVE, FILTER_VALIDATE_BOOLEAN);

        return $documentStorageDto;
    }

    public static function mapVideoDetailFromEntity($documentStorage): ?VideoDetailDto {
        if ($documentStorage == null) return null;

        $videoDetailDto = VideoDetailDto::createEmpty();
        // Thông tin document storage
        $videoDetailDto->id = $documentStorage->ID;
        $videoDetailDto->name = $documentStorage->NAME;
        $videoDetailDto->originalName = $documentStorage->ORIGINAL_NAME;
        $videoDetailDto->extension = $documentStorage->EXTENSION;
        $videoDetailDto->path = $documentStorage->PATH;
        $videoDetailDto->directory = $documentStorage->DIRECTORY;
        $videoDetailDto->size = $documentStorage->SIZE;
        $videoDetailDto->md5 = $documentStorage->MD5;
        $videoDetailDto->typeFile = $documentStorage->TYPE_FILE;
        $videoDetailDto->description = $documentStorage->DESCRIPTION;
        $videoDetailDto->imageThumnail = $documentStorage->ATTR1;

        // Thông tin modire và trạng thái hoạt động
        $videoDetailDto->crtId = $documentStorage->CRT_ID;
        $videoDetailDto->crtDt = $documentStorage->CRT_DT;
        $videoDetailDto->updId = $documentStorage->UPD_ID;
        $videoDetailDto->updDt = $documentStorage->UPD_DT;
        if (!is_null($documentStorage->IS_ACTIVE)) $videoDetailDto->isActive = filter_var($documentStorage->IS_ACTIVE, FILTER_VALIDATE_BOOLEAN);

        return $videoDetailDto;
    }
    
    private static function issetkey($array, $fiedlName, $defaultValue = null) {
        return isset($array[$fiedlName]) ? $array[$fiedlName] : $defaultValue;
    }

}
