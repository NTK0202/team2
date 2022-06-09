<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterOverTimeRequest;
use App\Services\RegisterOverTimeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterOverTimeController extends Controller
{

    protected $registerOverTimeService;

    public function __construct(RegisterOverTimeService $registerOverTimeService)
    {
        $this->middleware('auth:api');
        $this->registerOverTimeService = $registerOverTimeService;
    }


    public function createRequestOverTime(RegisterOverTimeRequest $request)
    {
        if ($this->registerOverTimeService->checkRequest($request['request_for_date'])) {
            $this->registerOverTimeService->createRequestOverTime($request);
        }

        return response()->json(['message' => 'You have run out of requests !']);
    }

    public function updateRequestOverTime(RegisterOverTimeRequest $request)
    {
        if ($this->registerOverTimeService->checkRequest($request['request_for_date'])) {
            $this->registerOverTimeService->updateRequestOverTime($request);
        }

        return response()->json(['message' => 'Update successfully !']);
    }
}
