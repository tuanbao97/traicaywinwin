<?php

namespace App\Repository\impl;

use App\Models\DocumentStorage;
use App\Repository\BaseRepository;
use App\Repository\DocumentStorageRepository;

class DocumentStorageRepositoryImpl extends BaseRepository implements DocumentStorageRepository
{
    public function getModel()
    {
        return DocumentStorage::class;
    }

    public function getFileDinhKemByIdAndStatus(int $documentStorageId, string $status)
    {
        return $this->model
                    ->where([
                        ['ID', '=', $documentStorageId],
                        ['STATUS', '=', $status]
                    ])->first();
    }

    public function getListFileDinhKemAndStatus($ids, $names, string $status)
    {
        $query = DocumentStorage::query();
        if (!empty($ids)) {
            $query->whereIn('ID', $ids);
        }
        if (!empty($names)) {
            $query->whereIn('NAME', $names);
        }
        $query->where([
            ['STATUS', '=', $status]
        ]);
        return $query->get();
    }
    

   
}
