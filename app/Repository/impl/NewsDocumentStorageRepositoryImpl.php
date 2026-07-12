<?php

namespace App\Repository\impl;

use App\Enum\AppConstant;
use App\Mapper\NewsDocumentStorageMapper;
use App\Models\NewsDocumentStorage;
use App\Repository\BaseRepository;
use App\Repository\NewsDocumentStorageRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Dto\ApiResponseDto;
use App\Utils\PaginationUtils;
use App\Utils\CamelToSnakeUpper;

class NewsDocumentStorageRepositoryImpl extends BaseRepository implements NewsDocumentStorageRepository
{
    public function getModel()
    {
        return NewsDocumentStorage::class;
    }

    public function saveNewsDocumentStorages($newsId, array $documentStorages)
    {
        if (isset($documentStorages) && count($documentStorages) > 0) {
            foreach ($documentStorages as $index => $documentStorage) {
                $data = [
                    'NEWS_ID' => $newsId
                    , 'DOCUMENT_STORAGE_ID' => $documentStorage['ID']
                    , 'TYPE' => !empty($documentStorage['TYPE']) ? $documentStorage['TYPE'] : $documentStorage['EXTENSION']
                    , 'EXTENSION' => !empty($documentStorage['EXTENSION']) ? $documentStorage['EXTENSION'] : null
                    , 'IS_THUMNAIL' => !empty($documentStorage['IS_THUMNAIL']) ? $documentStorage['IS_THUMNAIL'] : null
                    , 'SORT_ORDER' => !empty($documentStorage['SORT_ORDER']) ? $documentStorage['SORT_ORDER'] : null
                    , 'ATTR1' => !empty($documentStorage['ATTR1']) ? $documentStorage['ATTR1'] : null
                ];
                $newsDocumentStorage = NewsDocumentStorageMapper::mapFromArray(new NewsDocumentStorage(), $data);
                // Save
                $newsDocumentStorage->save();
            }
        }
    }

    public function deleteAllTinTucFileDinhKems($newsId) : bool
    {
        return DB::table('news_document_storage')
            ->where('NEWS_ID', $newsId)
            ->delete();
    }
} 