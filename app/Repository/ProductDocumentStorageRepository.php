<?php

namespace App\Repository;

interface ProductDocumentStorageRepository extends RepositoryInterface
{
    public function deleteAllSanPhamFileDinhKems($productId) : bool;

    public function saveProductDocumentStorages($productId, array $documentStorages);
}

