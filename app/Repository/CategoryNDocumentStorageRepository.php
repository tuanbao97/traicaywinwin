<?php

namespace App\Repository;

interface CategoryNDocumentStorageRepository
{

    public function deleteAllDanhMucTinTucFileDinhKem($categoryNId) : bool;

    public function saveCategoryNDocumentStorages($categoryNId, array $documentStorages);

}
