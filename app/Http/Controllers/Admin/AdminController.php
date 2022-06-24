<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $AdminService;

    public function __construct(AdminService $AdminService)
    {
        $this->AdminService = $AdminService;
    }

    public function index(AdminRequest $request)
    {
        return response()->json([
            'request' => $this->AdminService->getRequest($request),
            'per_page_config' => config('common.per_page'),
        ]);
    }

    public function show($id)
    {
        return $this->AdminService->show($id);
    }

    public function update(AdminRequest $request, $id)
    {
        return $this->AdminService->approve($request, $id);
    }
}
