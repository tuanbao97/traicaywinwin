<?php

namespace App\Repository;

use App\Models\Transaction;
use Illuminate\Pagination\LengthAwarePaginator;

interface TransactionRepository extends RepositoryInterface
{
    public function getDetail(int $id): ?Transaction;

    public function getDetailWithItems(int $id): ?Transaction;

    public function getList(
        ?string $tuKhoa,
        ?string $trangThaiGiaoDich,
        int $page,
        int $perPage
    ): LengthAwarePaginator;
}
