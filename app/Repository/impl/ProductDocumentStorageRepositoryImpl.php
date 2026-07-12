<?php

namespace App\Repository\impl;

use App\Enum\AppConstant;
use App\Mapper\CategoryPDocumentStorageMapper;
use App\Mapper\ProductDocumentStorageMapper;
use App\Models\ProductDocumentStorage;
use App\Repository\BaseRepository;
use App\Repository\ProductDocumentStorageRepository;

class ProductDocumentStorageRepositoryImpl extends BaseRepository implements ProductDocumentStorageRepository
{

    public function getModel()
    {
        return ProductDocumentStorage::class;
    }

    public function deleteAllSanPhamFileDinhKems($productId) : bool {
        $isDeleted = ProductDocumentStorage::where([
            ['PRODUCT_ID', '=', $productId],
            ['STATUS', '=', AppConstant::STATUS_USING]
        ])->delete();
        return $isDeleted;
    }

    public function saveProductDocumentStorages($productId, array $documentStorages) {
        if (isset($documentStorages) && count($documentStorages) > 0) {
            foreach ($documentStorages as $index => $documentStorage) {
                $data = [
                    'PRODUCT_ID' => $productId
                    , 'DOCUMENT_STORAGE_ID' => $documentStorage['ID']
                    , 'TYPE' => !empty($documentStorage['TYPE']) ? $documentStorage['TYPE'] : $documentStorage['EXTENSION']
                    , 'EXTENSION' => !empty($documentStorage['EXTENSION']) ? $documentStorage['EXTENSION'] : null
                    , 'IS_THUMNAIL' => !empty($documentStorage['IS_THUMNAIL']) ? $documentStorage['IS_THUMNAIL'] : null
                    , 'SORT_ORDER' => !empty($documentStorage['SORT_ORDER']) ? $documentStorage['SORT_ORDER'] : null
                    , 'ATTR1' => !empty($documentStorage['ATTR1']) ? $documentStorage['ATTR1'] : null
                ];
                $productDocumentStorage = ProductDocumentStorageMapper::mapFromArray(new ProductDocumentStorage(), $data);
                // Save
                $productDocumentStorage->save();
            }
        }
    }

}
