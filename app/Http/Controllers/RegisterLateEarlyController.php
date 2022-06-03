<?php

namespace App\Http\Controllers;

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

}
