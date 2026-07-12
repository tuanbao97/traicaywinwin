<?php

namespace App\Service;

use App\Models\Title;
use Illuminate\Http\Request;

interface TitleService
{
    public function getTilteActiveByUserId(int $userId) : ?Title;

}
