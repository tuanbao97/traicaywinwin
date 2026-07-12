<?php

namespace App\Repository;

use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryNRepository extends RepositoryInterface
{
    public function getSortOrder() : int;

    public function getListDanhMucTinTucWithChilds(?bool $isApiPublic, int $page, int $perPage) : LengthAwarePaginator;

    public function getDetailDanhMucTinTuc(int $id);

    public function getListDanhMucTinTuc(?bool $isGetAllParentAndChilds, ?int $parentId, ?bool $trangThaiHoatDong, ?string $tuKhoa
        , int $page, int $perPage
    ) : LengthAwarePaginator;

    public function updateParentIdToNullById(int $id);

}
