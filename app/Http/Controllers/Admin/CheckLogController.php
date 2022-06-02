<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckLogParamsRequest;
use App\Services\CheckLogService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CheckLogController extends Controller
{
    protected $checkLogService;

    public function __construct(CheckLogService $checkLogService)
    {
        $this->middleware('auth:api');
        $this->checkLogService = $checkLogService;
    }

    public function getTimeLogs(CheckLogParamsRequest $request, $member_id): JsonResponse
    {
        return response()->json(['time_logs' => $this->checkLogService->getTimeLogs($request, $member_id)]);
    }
}
