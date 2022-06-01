<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function addPermission($id, Request $request)
    {
        return $this->roleService->addPermission($id, $request);
    }

    public function updatePermission($id, Request $request)
    {
        return $this->roleService->updatePermission($id, $request);
    }

    public function deletePermission($id, Request $request)
    {
        return $this->roleService->deletePermission($id, $request);
    }
}
