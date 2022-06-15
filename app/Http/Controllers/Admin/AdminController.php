<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApproveRequest;
use App\Services\RequestService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $requestService;

    public function __construct(RequestService $requestService)
    {
        $this->requestService = $requestService;
    }

    public function index()
    {
        return $this->requestService->getRequestConfirm();
    }

    public function update(ApproveRequest $request, $id)
    {
        return $this->requestService->approve($request, $id);
    }
}
