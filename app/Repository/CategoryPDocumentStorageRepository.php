<?php

namespace App\Repository;

interface CategoryPDocumentStorageRepository
{

    public function deleteAllDanhMucSanPhamFileDinhKem($categoryPId) : bool;

    public function saveCategoryPDocumentStorages($categoryPId, array $documentStorages);

}
