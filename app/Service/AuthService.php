<?php

namespace App\Service;

use App\Dto\auth\ValidateAccessTokenDto;
use App\Dto\auth\ValidateUserDto;
use App\Models\User;
use Illuminate\Http\Request;
use stdClass;

interface AuthService
{
    
    public function registerUser(Request $request);

    public function loginUser(Request $request);

    public function refreshToken(Request $request);

    public function logoutUser(Request $request);

    public function myInfo(Request $request);

    public function updateMyInfo(Request $request);

    public function updatePassword(Request $request);

    public function forgotPassword(Request $request);

    public function getCurrUser() : ?User;

    public function validateAccessToken(String $accessToken) : ValidateAccessTokenDto;

    public function validateUser(int $userId) : User;

    public function deleteAccessTokenAndRefreshToken(string $accessTokenId);

    public function getUserByResetKey(Request $request);

    public function resetPasswordByResetKey(Request $request);
    
}
