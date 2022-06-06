<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterOTRequest;
use App\Services\RegisterOTService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterOTController extends Controller
{

    protected $registerOTService;

    public function __construct(RegisterOTService $registerOTService)
    {
        $this->middleware('auth:api');
        $this->registerOTService = $registerOTService;
    }

    public function getRequestOT($id): JsonResponse
    {
        return response()->json(['request' => $this->registerOTService->getRequestOT($id)]);
    }

    public function createRequestOT(RegisterOTRequest $request)
    {
        $this->registerOTService->createRequestOT($request);

        return response()->json(['message' => 'Register successfully !']);
    }

    public function updateRequestOT(RegisterOTRequest $request, $id)
    {
        $this->registerOTService->updateRequestOT($request, $id);

        return response()->json(['message' => 'Update successfully !']);
    }
}
