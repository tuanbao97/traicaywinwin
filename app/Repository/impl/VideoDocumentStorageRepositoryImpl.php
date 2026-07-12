<?php

namespace App\Repository\impl;

use App\Enum\AppConstant;
use App\Mapper\VideoDocumentStorageMapper;
use App\Models\VideoDocumentStorage;
use App\Repository\BaseRepository;
use App\Repository\VideoDocumentStorageRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Dto\ApiResponseDto;
use App\Utils\PaginationUtils;
use App\Utils\CamelToSnakeUpper;

class VideoDocumentStorageRepositoryImpl extends BaseRepository implements VideoDocumentStorageRepository
{
    public function getModel()
    {
        return VideoDocumentStorage::class;
    }

    public function saveVideoDocumentStorages($videoId, array $documentStorages)
    {
        if (isset($documentStorages) && count($documentStorages) > 0) {
            foreach ($documentStorages as $index => $documentStorage) {
                $data = [
                    'VIDEO_ID' => $videoId
                    , 'DOCUMENT_STORAGE_ID' => $documentStorage['ID']
                    , 'TYPE' => !empty($documentStorage['TYPE']) ? $documentStorage['TYPE'] : $documentStorage['EXTENSION']
                    , 'EXTENSION' => !empty($documentStorage['EXTENSION']) ? $documentStorage['EXTENSION'] : null
                    , 'IS_THUMNAIL' => !empty($documentStorage['IS_THUMNAIL']) ? $documentStorage['IS_THUMNAIL'] : null
                    , 'SORT_ORDER' => !empty($documentStorage['SORT_ORDER']) ? $documentStorage['SORT_ORDER'] : null
                    , 'ATTR1' => !empty($documentStorage['ATTR1']) ? $documentStorage['ATTR1'] : null
                ];
                $videoDocumentStorage = VideoDocumentStorageMapper::mapFromArray(new VideoDocumentStorage(), $data);
                // Save
                $videoDocumentStorage->save();
            }
        }
    }

    public function deleteAllVideoFileDinhKems($videoId) : bool
    {
        return DB::table('video_document_storage')
            ->where('VIDEO_ID', $videoId)
            ->delete();
    }
}
