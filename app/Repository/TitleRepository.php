<?php

namespace App\Repository;

use App\Enum\TitleEnum;
use App\Models\Title;

interface TitleRepository extends RepositoryInterface
{
    public function createTitle(int $userId, TitleEnum $titleEnum) : Title;

    public function getTilteActiveByUserId(int $userId) : ?Title;

    public function hardDeleteTitlesByUserId(int $userId) : bool;
}
