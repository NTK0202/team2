<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterLateEaryRequest;
use App\Services\RegisterLateEarlyService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RegisterLateEarlyController extends Controller
{

    protected $registerLateEarlyService;

    public function __construct(RegisterLateEarlyService $registerLateEarlyService)
    {
        $this->middleware('auth:api');
        $this->registerLateEarlyService = $registerLateEarlyService;
    }

    public function createRequestLateEarly(RegisterLateEaryRequest $request)
    {
        if ($this->registerLateEarlyService->checkRequest($request['request_for_date'])) {
            return $this->registerLateEarlyService->createRequestLateEarly($request);
        }

        return response()->json(['message' => 'You have run out of requests !']);
    }

    public function updateRequestLateEarly(RegisterLateEaryRequest $request)
    {
        if ($this->registerLateEarlyService->checkRequest($request['request_for_date'])) {
            return $this->registerLateEarlyService->updateRequestLateEarly($request);
        }

        return response()->json(['message' => 'Update successfully !']);
    }
}
