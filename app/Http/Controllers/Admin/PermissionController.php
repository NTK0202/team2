<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PermissionService;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function list()
    {
        return $this->permissionService->get();
    }

    public function create(Request $request)
    {
        $this->permissionService->create($request);

        return response()->json(["message" => "Create permission successfully !"]);
    }

    public function update($id, Request $request)
    {
        $this->permissionService->update($id, $request);

        return response()->json(["message" => "Update permission successfully !"]);
    }

    public function delete($id)
    {
        return $this->permissionService->delete($id);
    }
}
