<?php

namespace App\Repository;

use App\Enum\SettingEnum;
use App\Models\Setting;
use Illuminate\Pagination\LengthAwarePaginator;

interface SettingRepository extends RepositoryInterface
{
    public function getSettingDetail(string $code) : ?Setting;

    public function getListSettingByType(SettingEnum $type
        , ?string $tuKhoa
        , int $page, int $perPage
    ) : LengthAwarePaginator;
}
