<?php

namespace App\Repository;

interface VideoDocumentStorageRepository extends RepositoryInterface
{
    public function saveVideoDocumentStorages($videoId, array $documentStorages);

    public function deleteAllVideoFileDinhKems($videoId) : bool;
}
