<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterForgetRequest;
use App\Services\RegisterForgetService;
use Illuminate\Http\Request;

class RegisterForgetController extends Controller
{
    protected $registerForgetService;

    public function __construct(RegisterForgetService $registerForgetService)
    {
        $this->registerForgetService = $registerForgetService;
    }

    public function createForget(RegisterForgetRequest $request)
    {
        if ($this->registerForgetService->checkRequest($request['request_for_date'])) {
            return $this->registerForgetService->create($request);
        }

        return response()->json(['message' => 'You have run out of requests !']);
    }

    public function updateForget(RegisterForgetRequest $request)
    {
        if ($this->registerForgetService->checkRequest($request['request_for_date'])) {
            return $this->registerForgetService->updateForget($request);
        }

        return response()->json(['message' => 'You have run out of requests !']);
    }
}
