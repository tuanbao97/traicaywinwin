<?php

namespace App\Repository;


interface DocumentStorageRepository extends RepositoryInterface
{
    public function getFileDinhKemByIdAndStatus(int $documentStorageId, string $status);

    public function getListFileDinhKemAndStatus($ids, $names, string $status);

}
