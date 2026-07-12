<?php

namespace App\Repository;

interface NewsDocumentStorageRepository extends RepositoryInterface
{
    public function saveNewsDocumentStorages($newsId, array $documentStorages);

    public function deleteAllTinTucFileDinhKems($newsId) : bool;
} 