<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepository extends RepositoryInterface
{
    public function getDetailUser(string $email) : ?User;

    public function getUserById(int $id) : ?User;
    
    public function updateMyInfo(string $email, Request $request);

    public function updatePassword(string $email, Request $request);

    public function getUserByResetKey(string $resetKey) : ?User;

    public function getListUser(?string $tuKhoa, ?bool $trangThaiHoatDong, ?int $vaiTroId
        , ?bool $isApiPublic
        , int $page, int $perPage) : LengthAwarePaginator;
}
