<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkSheetParamsRequest;
use App\Services\WorkSheetService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkSheetController extends Controller
{
    protected $worksheetService;
    protected $member_id;

    public function __construct(WorkSheetService $worksheetService)
    {
        $this->worksheetService = $worksheetService;
        $this->member_id = Auth::id();
    }

    public function list(WorkSheetParamsRequest $request)
    {
        return response()->json(['worksheet' => $this->worksheetService->filter($request,  $this->member_id), 'per_page' => config('per_page')]);
    }

    public function getRequest($id, Request $request)
    {
        return $this->worksheetService->find($id, $request);
    }
}
