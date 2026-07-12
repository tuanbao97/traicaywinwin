<?php

namespace App\Repository;

interface ProductCategoryRepository extends RepositoryInterface
{
    public function deleteAllSanPhamDanhMucSanPham($productId) : bool;

    public function saveProductCategories($productId, array $categories);

}
