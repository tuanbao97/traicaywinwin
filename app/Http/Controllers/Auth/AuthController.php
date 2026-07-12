<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\ForgotPasswordRequest;
use App\Http\Requests\auth\GetUserDetailResetPasswordRequest;
use App\Http\Requests\auth\LoginUserRequest;
use App\Http\Requests\auth\RefreshTokenRequest;
use App\Http\Requests\auth\RegisterUserRequest;
use App\Http\Requests\auth\ResetPasswordByResetKeyRequest;
use App\Http\Requests\auth\UpdateMyInfoRequest;
use App\Http\Requests\auth\UpdatePasswordRequest;
use App\Service\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function registerUser(RegisterUserRequest $request) {
        return $this->authService->registerUser($request);
    }

    public function loginUser(LoginUserRequest $request) {
        return $this->authService->loginUser($request);
    }

    public function refreshToken(RefreshTokenRequest $request) {
        return $this->authService->refreshToken($request);
    }

    public function logoutUser(Request $request) {
        return $this->authService->logoutUser($request);
    }

    public function myInfo(Request $request) {
        return $this->authService->myInfo($request);
    }

    public function updateMyInfo(UpdateMyInfoRequest $request) {
        return $this->authService->updateMyInfo($request);
    }    

    public function updatePassword(UpdatePasswordRequest $request) {
        return $this->authService->updatePassword($request);
    }

    public function forgotPassword(ForgotPasswordRequest $request) {
        return $this->authService->forgotPassword($request);
    }

    public function getUserByResetKey(GetUserDetailResetPasswordRequest $request) {
        return $this->authService->getUserByResetKey($request);
    }

    public function resetPasswordByResetKey(ResetPasswordByResetKeyRequest $request) {
        return $this->authService->resetPasswordByResetKey($request);
    }

}
