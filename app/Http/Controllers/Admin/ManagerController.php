<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagerRequest;
use App\Http\Requests\ShowRequest;
use App\Services\ManagerService;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    protected $managerService;

    public function __construct(ManagerService $managerService)
    {
        $this->managerService = $managerService;
    }

    public function index(ManagerRequest $request)
    {
        return response()->json([
            'request_sent' => $this->managerService->getRequestSent($request),
            'per_page_config' => config('common.per_page'),
        ]);
    }

    public function show($id)
    {
        return $this->managerService->show($id);
    }

    public function update(ManagerRequest $request, $id)
    {
        return $this->managerService->confirm($request, $id);
    }
}
