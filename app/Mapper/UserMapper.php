<?php

namespace App\Mapper;

use App\Dto\user\UserDetailDto;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class UserMapper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function mapFromArray(User $user, array $data) : ?User {
        if ($user == null) return null;

        $user->ID = self::issetKey($data, 'ID');
        $user->EMAIL = self::issetKey($data, 'EMAIL');
        $user->USERNAME = self::issetKey($data, 'USERNAME');
        $user->PASSWORD = self::issetKey($data, 'PASSWORD');
        $user->FULL_NAME = self::issetKey($data, 'FULL_NAME');
        $user->IS_ACTIVE = filter_var(self::issetkey($data, 'TRANG_THAI_HOAT_DONG', true), FILTER_VALIDATE_BOOLEAN);
        $user->COUNT_LOGIN_FAIL = self::issetKey($data, 'COUNT_LOGIN_FAIL');
        $user->ACTIVE_KEY = self::issetKey($data, 'ACTIVE_KEY');
        $user->RESET_KEY = self::issetKey($data, 'RESET_KEY');
        $user->RESET_DATE = self::issetKey($data, 'RESET_DATE');

        $user->CRT_DT = !is_null($user->CRT_DT) ? $user->CRT_DT : Carbon::now();
        $user->UPD_DT = Carbon::now();
        $user->CRT_ID = !is_null($user->CRT_ID) ? $user->CRT_ID : Auth::user()?->ID;
        $user->UPD_ID = Auth::user()?->ID;
        $user->CRT_NAME = !is_null($user->CRT_NAME) ? $user->CRT_NAME : Auth::user()?->FULL_NAME;
        $user->UPD_NAME = Auth::user()?->FULL_NAME;

        return $user;
    }

    public static function mapUserDetailDtoFromEntity(?User $user, bool $isFetchPermission = false): ?UserDetailDto {
        if ($user == null) return null;

        $userDetail = UserDetailDto::createEmpty();

        $userDetail->id = $user->ID;
        $userDetail->email = $user->EMAIL;
        $userDetail->userName = $user->USERNAME;
        $userDetail->fullName = $user->FULL_NAME;

        $userDetail->address = $user->ADDRESS;
        $userDetail->mobile = $user->MOBILE;
        $userDetail->hinhAnhDaiDien = $user->HINH_ANH_DAI_DIEN;
        $userDetail->urlFacebook = $user->URL_FACEBOOK;
        $userDetail->urlZalo = $user->URL_ZALO;
        $userDetail->urlMessenger = $user->URL_MESSENGER;

        if ($isFetchPermission === true) {
            $userDetail->permissions = $user->PERMISSIONS;
        }

        if (!is_null($user->TITLE)) {
            $userDetail->title = $user->TITLE;
        }

        $userDetail->roleId = $user->ROLE_ID;
        $userDetail->roleName = $user->ROLE_NAME;
        $userDetail->roleCode = $user->ROLE_CODE;
       
        
        // Thông tin modire và trạng thái hoạt động
        $userDetail->crtId = $user->CRT_ID;
        $userDetail->crtDt = $user->CRT_DT;
        $userDetail->updId = $user->UPD_ID;
        $userDetail->updDt = $user->UPD_DT;
        $userDetail->crtName = $user->CRT_NAME;
        $userDetail->updName = $user->UPD_NAME;
        $userDetail->status = $user->STATUS;
        if (!is_null($user->IS_ACTIVE)) $userDetail->isActive = filter_var($user->IS_ACTIVE, FILTER_VALIDATE_BOOLEAN);

        return $userDetail;
    }

    /**
     * Map list user detail from paginator
     * 
     * @param Collection<User> $listUser
     * @return Collection<UserDetailDto>
     */
    public static function mapListUserDetailFromPaginator(Collection $listUser) : Collection {
        $listUserDto = new Collection();
        if ($listUser->isEmpty()) return $listUserDto;

        foreach ($listUser as $key => $user) {
            $listUserDto->push(self::mapUserDetailDtoFromEntity($user, false));
        }
        return $listUserDto;
    }
    
    private static function issetKey($array, $fieldName, $defaultValue = null) {
        return isset($array[$fieldName]) ? $array[$fieldName] : $defaultValue;
    }

}
