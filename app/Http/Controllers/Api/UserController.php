<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\UserActiveRequest;
use App\Http\Requests\user\UserDeleteRequest;
use App\Http\Requests\user\UserDetailRequest;
use App\Http\Requests\user\UserDetailSaveRequest;
use App\Http\Requests\user\UserListRequest;
use App\Service\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Inject bean
    private UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function getListUser(UserListRequest $request) {
        return $this->userService->getListUser($request);
    }

    public function getListUserPublic(UserListRequest $request) {
        $request->merge([
            'IS_API_PUBLIC' => true
        ]);
        return $this->userService->getListUser($request);
    }

    public function activeUser($ID, UserActiveRequest $request): mixed {
        return $this->userService->activeUser($ID, $request);
    }

    public function deleteUser($ID, UserDeleteRequest $request) {
        return $this->userService->deleteUser($ID, $request);
    }

    public function getUserById($ID, UserDetailRequest $request): mixed {
        return $this->userService->getUserByIdRspApi($ID);
    }

    public function saveUser(UserDetailSaveRequest $request, $ID = null) {
        if ($ID === null) {
            // Create new user
            return $this->userService->createUser($request);
        } else {
            // Update existing user
            return $this->userService->updateUser($ID, $request);
        }
    }
}
