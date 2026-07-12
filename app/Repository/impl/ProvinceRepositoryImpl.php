<?php

namespace App\Repository\impl;

use App\Enum\AppConstant;
use App\Mapper\ProvinceMapper;
use App\Models\Province;
use App\Repository\BaseRepository;
use App\Repository\ProvinceRepository;
use Illuminate\Support\Collection;

class ProvinceRepositoryImpl extends BaseRepository implements ProvinceRepository
{
    public function getModel()
    {
        return Province::class;
    }

    public function saveProvinces(Collection $provinces)
    {
        if (!isset($provinces) || $provinces->count() == 0) return;

        foreach ($provinces as $key => $province) {
            $data = [
                'CODE' => $key,
                'NAME' => $province->tinhTP,
                'STATUS' => AppConstant::STATUS_USING,
                'SORT_ORDER' => $province->sttTinhTP
            ];
            $provinceEntity = Province::where([
                ['CODE', '=', $key]
            ])->first();
            $provinceEntity = is_null($provinceEntity) ? new Province() : $provinceEntity;

            // Mapper
            $provinceEntity = ProvinceMapper::mapFromArray($provinceEntity, $data);
            // Save database
            $provinceEntity->save();
        }
    }
    public function getListTinhThanh(?string $code) {        
        return Province::query()->where([
            ['STATUS', '=', AppConstant::STATUS_USING]
        ])->orderByRaw("
            CASE
                WHEN SORT_ORDER IS NOT NULL THEN SORT_ORDER
                ELSE 999999999
            END ASC
            , NAME ASC
        ")
        ->get();
    }
}
