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

    public function getRequestLateEarly($id): JsonResponse
    {
        return response()->json(['request' => $this->registerLateEarlyService->getRequestLateEarly($id)]);
    }

    public function createRequestLateEarly(RegisterLateEaryRequest $request)
    {
        $this->registerLateEarlyService->createRequestLateEarly($request);

        return response()->json(['message' => 'Register successfully !']);
    }

    public function updateRequestLateEarly(RegisterLateEaryRequest $request, $id)
    {
        $this->registerLateEarlyService->updateRequestLateEarly($request, $id);

        return response()->json(['message' => 'Update successfully !']);
    }
}
