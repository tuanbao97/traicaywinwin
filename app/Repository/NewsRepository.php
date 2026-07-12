<?php

namespace App\Repository;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface NewsRepository extends RepositoryInterface
{
    public function getDetailTinTucWithFetchEdger(int $id) : ?News;

    public function getDetailTinTuc(int $id) : ?News;

    public function getDetailBasicTinTuc(int $id) : ?News;

    public function getListTinTuc(?string $tuKhoa, ?array $arrDanhMucTinTucId, ?bool $trangThaiHoatDong
        , ?string $boLoc
        , ?array $arrNotInId
        , ?bool $newsHot
        , Request $request
        , ?bool $isApiPublic
        , int $page, int $perPage) : LengthAwarePaginator;

    public function deleteAllTinTucFileDinhKems($newsId) : bool;

    public function saveNewsDocumentStorages($newsId, array $documentStorages);

    public function deleteAllTinTucDanhMucTinTuc($newsId) : bool;

    public function saveNewsCategories($newsId, array $categories);
} 