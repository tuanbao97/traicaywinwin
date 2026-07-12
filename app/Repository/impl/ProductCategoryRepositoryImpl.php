<?php

namespace App\Repository\impl;

use App\Enum\AppConstant;
use App\Mapper\ProductCategoryMapper;
use App\Models\ProductCategory;
use App\Repository\BaseRepository;
use App\Repository\ProductCategoryRepository;

class ProductCategoryRepositoryImpl extends BaseRepository implements ProductCategoryRepository
{
    public function getModel()
    {
        return ProductCategory::class;
    }

    public function deleteAllSanPhamDanhMucSanPham($productId) : bool {
        $isDeleted = ProductCategory::where([
            ['PRODUCT_ID', '=', $productId],
            ['STATUS', '=', AppConstant::STATUS_USING]
        ])->delete();
        return $isDeleted;
    }

    public function saveProductCategories($productId, array $categories) {
        if (isset($categories) && count($categories) > 0) {
            foreach ($categories as $index => $category) {
                $data = [
                    'PRODUCT_ID' => $productId
                    , 'CATEGORY_ID' => $category['CATEGORY_ID']
                ];
                $productDocumentStorage = ProductCategoryMapper::mapFromArray(new ProductCategory(), $data);
                // Save
                $productDocumentStorage->save();
            }
        }
    }

}

