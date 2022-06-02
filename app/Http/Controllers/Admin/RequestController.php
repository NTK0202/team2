<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\RegisterService;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    protected $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function getRequest($id, $type)
    {
        return $this->registerService->findRequest($id, $type);
    }

    public function createForget(Request $request)
    {
        $this->registerService->createForget($request);

        return response()->json(['message' => 'Request forget successfully !']);
    }
}
