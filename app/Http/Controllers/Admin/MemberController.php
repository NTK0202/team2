<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Services\MemberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    protected $memberService;
    protected $member_id;

    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
        $this->member_id = Auth::id();
    }

    public function edit()
    {
        return response()->json(['member' => $this->memberService->find($this->member_id)]);
    }

    public function update(MemberRequest $request)
    {
        $this->memberService->update($this->member_id, $request);

        return response()->json(['message' => "Update member successfully !"]);
    }
}
