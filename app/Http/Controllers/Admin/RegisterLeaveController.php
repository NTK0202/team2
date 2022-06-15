<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterLeaveRequest;
use App\Services\RegisterLeaveService;
use Illuminate\Http\Request;

class RegisterLeaveController extends Controller
{
    protected $registerLeaveService;

    public function __construct(RegisterLeaveService $registerLeaveService)
    {
        $this->registerLeaveService = $registerLeaveService;
    }

    public function createLeave(RegisterLeaveRequest $request)
    {
        if ($this->registerLeaveService->checkRequest($request['request_for_date'])) {
            return $this->registerLeaveService->create($request);
        }

        return response()->json(['message' => 'You have run out of requests !']);
    }

    public function updateLeave(RegisterLeaveRequest $request)
    {
        if ($this->registerLeaveService->checkRequest($request['request_for_date'])) {
            return $this->registerLeaveService->updateLeave($request);
        }

        return response()->json(['message' => 'You have run out of requests !']);
    }
}
