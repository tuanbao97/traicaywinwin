<?php

namespace App\Repository\impl;

use App\Enum\AppConstant;
use App\Enum\SettingEnum;
use App\Models\Setting;
use App\Repository\BaseRepository;
use App\Repository\SettingRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class SettingRepositoryImpl extends BaseRepository implements SettingRepository
{
 
    public function getModel()
    {
        return Setting::class;
    }

    public function getSettingDetail(string $code) : ?Setting {
        return Setting::query()
            ->where([
                ['CODE', '=', $code]
                , ['STATUS', '=', AppConstant::STATUS_USING]
            ])->first();
    }

    public function getListSettingByType(SettingEnum $type
        , ?string $tuKhoa
        , int $page, int $perPage) : LengthAwarePaginator {
        $query = Setting::query()
                ->from('setting AS s')
                ->where([
                    ['s.STATUS', '=', AppConstant::STATUS_USING]
                    , ['s.TYPE', '=', $type->name]
                ])
                ->select(
                    's.*'
                );


        if (!blank($tuKhoa)) {
            $query->where(
                function($query) use ($tuKhoa) {
                    $query->where([
                        ['s.NAME', 'like', '%' . $tuKhoa . '%']
                    ])->orWhere([
                        ['s.VALUE', 'like', '%' . $tuKhoa . '%']
                    ])->orWhere([
                        ['s.DESCRIPTION', 'like', '%' . $tuKhoa . '%']
                    ]);
                }
            );
        }

        $query->orderBy('s.CRT_DT', 'desc');

        $query = $query->paginate($perPage, ['*'], 'page', $page);
        return $query;
    }
}
