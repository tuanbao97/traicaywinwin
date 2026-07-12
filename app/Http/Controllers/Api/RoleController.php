<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\role\RoleListRequest;
use App\Service\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Inject beans
    private RoleService $roleService;

    public function __construct(RoleService $roleService) {
        $this->roleService = $roleService;
    }

    public function getListRole(RoleListRequest $request) {
        return $this->roleService->getListRole($request);
    }
}
