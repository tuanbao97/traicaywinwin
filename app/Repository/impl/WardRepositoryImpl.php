<?php

namespace App\Repository\impl;

use App\Enum\AppConstant;
use App\Mapper\WardMapper;
use App\Models\Ward;
use App\Repository\BaseRepository;
use App\Repository\WardRepository;
use Illuminate\Support\Collection;

class WardRepositoryImpl extends BaseRepository implements WardRepository
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
        return Ward::class;
    }

    public function saveWards(Collection $wards)
    {
        if (!isset($wards) || $wards->count() == 0) return;
        
        foreach ($wards as $key => $district) {
            $data = [
                'CODE' => $key,
                'NAME' => $district->phuongXa,
                'TYPE' => $district->capPX,
                'DISTRICT_CODE' => $district->maQH,
                'STATUS' => AppConstant::STATUS_USING,
                'SORT_ORDER' => $district->sttPhuongXa
            ];

            $wardEntity = Ward::where([
                ['CODE', '=', $key],
                ['DISTRICT_CODE', '=', $district->maQH]
            ])->first();
            $wardEntity = is_null($wardEntity) ? new Ward() : $wardEntity;
            
            // Mapper
            $wardEntity = WardMapper::mapFromArray($wardEntity, $data);
            // Save database
            $wardEntity->save();
        }
    }

    public function getListPhuongXaThiTran(?string $code, ?string $districtCode) {
        $query = Ward::query();
        if (!is_null($code)) {
            $query->where([
                ['CODE', '=', $code]
            ]);
        }
        if (!is_null($districtCode)) {
            $query->where([
                ['DISTRICT_CODE', '=', $districtCode]
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
