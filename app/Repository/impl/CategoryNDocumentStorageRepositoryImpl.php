<?php

namespace App\Repository\impl;

use App\Mapper\CategoryNDocumentStorageMapper;
use App\Models\CategoryNDocumentStorage;
use App\Repository\BaseRepository;
use App\Repository\CategoryNDocumentStorageRepository;

class CategoryNDocumentStorageRepositoryImpl extends BaseRepository implements CategoryNDocumentStorageRepository
{
    public function getModel()
    {
        return CategoryNDocumentStorage::class;
    }
    
    public function deleteAllDanhMucTinTucFileDinhKem($categoryNId): bool
    {
        return $this->model->where([
            ['CATEGORY_N_ID', '=', $categoryNId]
        ])->delete();
    }

    public function saveCategoryNDocumentStorages($categoryNId, array $documentStorages)
    {
        if (isset($documentStorages) && count($documentStorages) > 0) {
            foreach ($documentStorages as $index => $documentStorage) {
                $data = [
                    'CATEGORY_N_ID' => $categoryNId
                    , 'DOCUMENT_STORAGE_ID' => $documentStorage['ID']
                    , 'TYPE' => !empty($documentStorage['TYPE']) ? $documentStorage['TYPE'] : $documentStorage['EXTENSION']
                    , 'EXTENSION' => !empty($documentStorage['EXTENSION']) ? $documentStorage['EXTENSION'] : null
                    , 'IS_THUMNAIL' => !empty($documentStorage['IS_THUMNAIL']) ? $documentStorage['IS_THUMNAIL'] : null
                    , 'SORT_ORDER' => !empty($documentStorage['SORT_ORDER']) ? $documentStorage['SORT_ORDER'] : null
                    , 'ATTR1' => !empty($documentStorage['ATTR1']) ? $documentStorage['ATTR1'] : null
                    , 'ATTR2' => $documentStorage['ATTR2'] ?? null
                ];
                $categoryNDocumentStorage = CategoryNDocumentStorageMapper::mapFromArray(new CategoryNDocumentStorage(), $data);
                // Save
                $categoryNDocumentStorage->save();
            }
        }
    }


}
