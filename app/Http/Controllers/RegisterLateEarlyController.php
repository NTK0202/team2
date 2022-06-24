<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterLateEaryRequest;
use App\Services\RegisterLateEarlyService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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

        return response()->json(['message' => 'You have run out of requests late/early !'], Response::HTTP_CONFLICT);
    }

    public function updateRequestLateEarly(RegisterLateEaryRequest $request)
    {
        if ($this->registerLateEarlyService->checkRequest($request['request_for_date'])) {
            return $this->registerLateEarlyService->updateRequestLateEarly($request);
        }

        return response()->json(['message' => 'Update successfully !'], Response::HTTP_OK);
    }

    public function getWorksheetByWorkDate($work_date)
    {
        return $this->registerLateEarlyService->getWorksheetByWorkDate($work_date);
    }
}
