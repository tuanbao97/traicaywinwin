<?php

namespace App\Repository\impl;

use App\Enum\AppConstant;
use App\Mapper\CategoryPDocumentStorageMapper;
use App\Models\CategoryPDocumentStorage;
use App\Repository\BaseRepository;
use App\Repository\CategoryPDocumentStorageRepository;

class CategoryPDocumentStorageRepositoryImpl extends BaseRepository implements CategoryPDocumentStorageRepository
{
    public function getModel()
    {
        return CategoryPDocumentStorage::class;
    }
    
    public function deleteAllDanhMucSanPhamFileDinhKem($categoryPId): bool
    {
        return $this->model->where([
            ['CATEGORY_P_ID', '=', $categoryPId]
        ])->delete();
    }

    public function saveCategoryPDocumentStorages($categoryPId, array $documentStorages)
    {
        if (isset($documentStorages) && count($documentStorages) > 0) {
            foreach ($documentStorages as $index => $documentStorage) {
                $data = [
                    'CATEGORY_P_ID' => $categoryPId
                    , 'DOCUMENT_STORAGE_ID' => $documentStorage['ID']
                    , 'TYPE' => !empty($documentStorage['TYPE']) ? $documentStorage['TYPE'] : $documentStorage['EXTENSION']
                    , 'EXTENSION' => !empty($documentStorage['EXTENSION']) ? $documentStorage['EXTENSION'] : null
                    , 'IS_THUMNAIL' => !empty($documentStorage['IS_THUMNAIL']) ? $documentStorage['IS_THUMNAIL'] : null
                    , 'SORT_ORDER' => !empty($documentStorage['SORT_ORDER']) ? $documentStorage['SORT_ORDER'] : null
                    , 'ATTR1' => !empty($documentStorage['ATTR1']) ? $documentStorage['ATTR1'] : null
                    , 'ATTR2' => $documentStorage['ATTR2'] ?? null
                ];
                $categoryPDocumentStorage = CategoryPDocumentStorageMapper::mapFromArray(new CategoryPDocumentStorage(), $data);
                // Save
                $categoryPDocumentStorage->save();
            }
        }
    }


}
