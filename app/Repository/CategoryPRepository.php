<?php

namespace App\Repository;

use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryPRepository extends RepositoryInterface
{
    public function getSortOrder() : int;

    public function getListDanhMucSanPhamWithChilds(?bool $isApiPublic, int $page, int $perPage) : LengthAwarePaginator;

    public function getDetailDanhMucSanPham(int $id);

    public function getListDanhMucSanPham(?bool $isGetAllParentAndChilds, ?int $parentId, ?bool $trangThaiHoatDong, ?string $tuKhoa
        , ?bool $isApiPublic
        , int $page, int $perPage
    ) : LengthAwarePaginator;

    public function updateParentIdToNullById(int $id);

}
