<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Http\Request;

interface UserService
{
    
    public function getUserById(int $id) : ?User;

    public function getUserByResetKey(string $resetKey) : ?User;

    public function getListUser(Request $request);

    public function activeUser($id, Request $request);

    public function deleteUser($id, Request $request);

    public function getUserByIdRspApi(int $id);

    public function updateUser($id, Request $request);

    public function createUser(Request $request);
}
