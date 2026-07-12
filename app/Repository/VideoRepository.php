<?php

namespace App\Repository;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface VideoRepository extends RepositoryInterface
{
    public function getDetailVideo(int $id) : ?Video;
    
    public function getDetailVideoWithFetchEdger(int $id) : ?Video;

    public function getListVideo(?string $tuKhoa, ?bool $trangThaiHoatDong
        , ?string $boLoc
        , ?array $arrNotInId
        , ?bool $videoHot
        , Request $request
        , ?bool $isApiPublic
        , int $page, int $perPage) : LengthAwarePaginator;
}
