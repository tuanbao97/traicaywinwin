<?php

namespace App\Repository\impl;

use App\Enum\AppConstant;
use App\Enum\AuthConstant;
use App\Models\User;
use App\Repository\BaseRepository;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserRepositoryImpl extends BaseRepository implements UserRepository
{

    public function getModel()
    {
        return User::class;
    }

    public function getDetailUser(string $email) : ?User {
        if (blank($email)) return null;

        return User::query()->where([
            ['STATUS', '=', AppConstant::STATUS_USING],
            ['EMAIL', '=', $email]
        ])->first();
    }

    public function getUserById(int $id) : ?User {
        if (is_null($id)) return null;

        $user = User::query()
            ->from('user as u')
            ->leftJoin('user_profile as up', function($leftJoin) {
                $leftJoin->on('u.ID', '=', 'up.USER_ID')
                         ->where([
                            ['up.IS_DEFAULT', true],
                            ['up.STATUS', '=', AppConstant::STATUS_USING]
                         ]);
            })
            ->where([
                ['u.STATUS', '=', AppConstant::STATUS_USING],
                ['u.ID', '=', $id]
            ])
            ->select('u.*', 'up.MOBILE AS MOBILE', 'up.ADDRESS AS ADDRESS', 'up.mobile AS MOBILE', 'up.AVATAR_ID AS AVATAR_ID', 'up.ATTR1 AS URL_FACEBOOK', 'up.ATTR2 AS URL_ZALO', 'up.ATTR3 AS URL_MESSENGER')
            ->first();

            return $user;
    }
    
    public function updateMyInfo(string $email, Request $request) {
        User::where([
            ['STATUS', '=', AppConstant::STATUS_USING],
            ['EMAIL', '=', $email]
        ])->update([
            'FULL_NAME' => $request->input('FULL_NAME')
        ]);

        // User profile
        // Avatar
        $hinhAnhDaiDien = $request->input('HINH_ANH_DAI_DIEN');
        $avatarId = !is_null($hinhAnhDaiDien) && !is_null($hinhAnhDaiDien['ID']) ? $hinhAnhDaiDien['ID'] : null;
        $record = DB::table('user_profile')
        ->where([
            ['USER_ID', '=', $request->input('USER_ID')],
            ['IS_DEFAULT', '=', true],
            ['STATUS', '=', AppConstant::STATUS_USING],
        ])->first();
        
        if (is_null($record)) {
            // Insert
            DB::table('user_profile')
            ->insert([
                'USER_ID' => $request->input('USER_ID'),
                'IS_DEFAULT' => true,
                'STATUS' => AppConstant::STATUS_USING,
                'MOBILE' => $request->input('SO_DIEN_THOAI'),
                'ADDRESS' => $request->input('DIA_CHI'),
                'AVATAR_ID' => $avatarId,
                'ATTR1' => $request->input('DUONG_DAN_FACEBOOK'),
                'ATTR2' => $request->input('DUONG_DAN_ZALO'),
                'ATTR3' => $request->input('DUONG_DAN_MESSENGER'),
                'CRT_DT' => now(),
                'UPD_DT' => now(),
                'CRT_ID' => !is_null(Auth::user()) ? Auth::user()->ID : null,
                'UPD_ID' => !is_null(Auth::user()) ? Auth::user()->ID : null
            ]);
        } else {
            // Update
            DB::table('user_profile')
            ->where('id', $record->ID)
            ->update([
                'MOBILE' => $request->input('SO_DIEN_THOAI'),
                'ADDRESS' => $request->input('DIA_CHI'),
                'AVATAR_ID' => $avatarId,
                'ATTR1' => $request->input('DUONG_DAN_FACEBOOK'),
                'ATTR2' => $request->input('DUONG_DAN_ZALO'),
                'ATTR3' => $request->input('DUONG_DAN_MESSENGER'),
                'UPD_DT' => now(),
                'UPD_ID' => !is_null(Auth::user()) ? Auth::user()->ID : null
            ]);
        }
        
    }

    public function updatePassword(string $email, Request $request) {
        User::where([
            ['STATUS', '=', AppConstant::STATUS_USING],
            ['EMAIL', '=', $email]
        ])->update([
            'PASSWORD' => $request->input('NEW_PASSWORD')
        ]);
    }

    public function getUserByResetKey(string $resetKey) : ?User {
        if (is_null($resetKey)) return null;

        $user = User::query()
                ->where([
                    ['STATUS', '=', AppConstant::STATUS_USING],
                    ['RESET_KEY', '=', $resetKey]
                ])
                ->first();
        return $user;
    }

    public function getListUser(?string $tuKhoa, ?bool $trangThaiHoatDong, ?int $vaiTroId
        , ?bool $isApiPublic
        , int $page, int $perPage) : LengthAwarePaginator {
        $query = User::query()
            ->from('user as u')
            ->leftJoin('user_profile as up', function($leftJoin) {
                $leftJoin->on('u.ID', '=', 'up.USER_ID')
                        ->where([
                            ['up.IS_DEFAULT', true],
                            ['up.STATUS', '=', AppConstant::STATUS_USING]
                        ]);
            })
            ->join('title as t', function($innerJoin) {
                $innerJoin->on('u.ID', '=', 't.USER_ID')
                        ->where([
                            ['t.IS_ACTIVE', true],
                            ['t.STATUS', '=', AppConstant::STATUS_USING]
                        ]);
            })
            ->join('role as r', function($innerJoin) {
                $innerJoin->on('r.ID', '=', 't.ROLE_ID')
                        ->where([
                            ['t.STATUS', '=', AppConstant::STATUS_USING]
                        ]);
            })
            ->where([
                ['u.STATUS', '=', AppConstant::STATUS_USING]
            ]);

            if ($isApiPublic === true) {
                $query->where([
                    ['u.USERNAME', '!=', AuthConstant::USER_SUPER_ADMIN_USERNAME]
                ]);
            }

            $query->select('u.*', 'up.MOBILE AS MOBILE', 'up.ADDRESS AS ADDRESS', 'up.mobile AS MOBILE', 'up.AVATAR_ID AS AVATAR_ID', 'up.ATTR1 AS URL_FACEBOOK', 'up.ATTR2 AS URL_ZALO', 'up.ATTR3 AS URL_MESSENGER'
                , 'r.ID AS ROLE_ID', 'r.CODE AS ROLE_CODE', 'r.NAME AS ROLE_NAME')
            ;

            if (!blank($tuKhoa)) {
            $query->where(
                function($query) use ($tuKhoa) {
                    $query->where([
                        ['u.EMAIL', 'like', '%' . $tuKhoa . '%']
                    ])->orWhere([
                        ['u.USERNAME', 'like', '%' . $tuKhoa . '%']
                    ])->orWhere([
                        ['u.FULL_NAME', 'like', '%' . $tuKhoa . '%']
                    ])->orWhere([
                        ['up.MOBILE', 'like', '%' . $tuKhoa . '%']
                    ])->orWhere([
                        ['up.ADDRESS', 'like', '%' . $tuKhoa . '%']
                    ]);
                }
            );
        }

        if (!is_null($trangThaiHoatDong)) {
            $query->where([
                ['u.IS_ACTIVE', '=', $trangThaiHoatDong]
            ]);
        }

        if (!is_null($vaiTroId)) {
            $query->where([
                ['r.ID', '=', $vaiTroId]
            ]);
        }
        

        $query->orderBy('u.ID', 'asc');
        $query = $query->paginate($perPage, ['*'], 'page', $page);
        return $query;
    }
    
}
