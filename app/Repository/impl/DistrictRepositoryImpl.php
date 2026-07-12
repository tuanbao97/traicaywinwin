<?php

namespace App\Repository\impl;

use App\Enum\AppConstant;
use App\Repository\DistrictRepository;
use App\Repository\BaseRepository;
use Illuminate\Support\Collection;
use App\Models\District;
use App\Mapper\DistrictMapper;

class DistrictRepositoryImpl extends BaseRepository implements DistrictRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function getModel()
    {
        return District::class;
    }

    public function saveQuanHuyen(Collection $districts)
    {
        if (!isset($districts) || $districts->count() == 0) return;

        foreach ($districts as $key => $district) {
            $data = [
                'CODE' => $key,
                'NAME' => $district->quanHuyen,
                'PROVINCES_CODE' => $district->maTP,
                'STATUS' => AppConstant::STATUS_USING,
                'SORT_ORDER' => $district->sttQuanHuyen
            ];

            $districtEntity = District::where([
                ['CODE', '=', $key],
                ['PROVINCES_CODE', '=', $district->maTP]
            ])->first();
            $districtEntity = is_null($districtEntity) ? new District() : $districtEntity;

            // Mapper
            $districtEntity = DistrictMapper::mapFromArray($districtEntity, $data);
            // Save database
            $districtEntity->save();
        }

    }

    public function getListQuanHuyen(?string $code, ?string $provinceCode) {
        $query = District::query();
        if (!is_null($code)) {
            $query->where([
                ['CODE', '=', $code]
            ]);
        }
        if (!is_null($provinceCode)) {
            $query->where([
                ['PROVINCES_CODE', '=', $provinceCode]
            ]);
        }
        $query->where([
            ['STATUS', '=', AppConstant::STATUS_USING],
            ['IS_ACTIVE', '=', true]
        ])
        ->orderByRaw('
            CASE
                WHEN SORT_ORDER IS NOT NULL THEN SORT_ORDER
                ELSE 999999999
            END ASC
            , NAME ASC
        ');

        return $query->get();
    }

}
