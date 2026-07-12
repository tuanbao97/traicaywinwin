<?php

namespace App\Repository\impl;

use App\Enum\AppConstant;
use App\Enum\TitleEnum;
use App\Models\Title;
use App\Repository\BaseRepository;
use App\Repository\TitleRepository;
use Illuminate\Support\Facades\DB;

class TitleRepositoryImpl extends BaseRepository implements TitleRepository
{
    public function getModel()
    {
        return Title::class;
    }

    public function createTitle(int $userId, TitleEnum $titleEnum) : Title {
        $title = new Title();
        $title->USER_ID = $userId;
        $title->ROLE_ID = $titleEnum->withRoleId();
        $title->DESCRIPTION = $titleEnum->description();
        $title->SORT_ORDER = 1;
        $title->IS_ACTIVE = true;
        $title->STATUS = AppConstant::STATUS_USING;
        $title->save();
        return $title;
    }

    public function getTilteActiveByUserId(int $userId) : ?Title {
        if (is_null($userId)) return null;

        $currTitleActive = Title::query()
        ->from('title as t')
        ->join('user as u', function($innerJoin) {
            $innerJoin->on('t.USER_ID', '=', 'u.ID')
                      ->where([
                            ['u.STATUS', '=', AppConstant::STATUS_USING]
                      ]);
        })
        ->join('role as r', function($innerJoin) {
            $innerJoin->on('t.ROLE_ID', '=', 'r.ID')
                      ->where([
                            ['r.STATUS', '=', AppConstant::STATUS_USING]
                      ]);
        })
        ->where([
            ['t.STATUS', '=', AppConstant::STATUS_USING],
            ['t.IS_ACTIVE', true],
            ['t.USER_ID', '=', $userId]
        ])
        ->select('t.*', 'r.NAME AS ROLE_NAME')
        ->first();

        return $currTitleActive;
    }

    public function hardDeleteTitlesByUserId(int $userId) : bool {
        return $this->model->where([
            ['USER_ID', '=', $userId],
        ])->delete();
    }
}
