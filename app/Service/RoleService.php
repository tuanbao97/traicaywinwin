<?php

namespace App\Service;

use Illuminate\Http\Request;

interface RoleService
{
    public function getListRole(Request $request);
}
