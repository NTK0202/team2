<?php

namespace App\Repositories;

use App\Models\LateEarly;
use App\Models\Worksheet;
use Illuminate\Support\Facades\Auth;

class RegisterLateEarlyRepository extends BaseRepository
{

    public function getModel(): string
    {
        return LateEarly::class;
    }

    public function getRequestLateEarly($id)
    {
        $requestType = 4;

        $worksheet = Worksheet::where('id', $id)
            ->where('member_id', Auth::user()->id)
            ->first();

        $request = LateEarly::where('member_id', Auth::user()->id)
            ->where('request_for_date', 'like', $worksheet->work_date)
            ->where('request_type', $requestType)
            ->first();

        if (!$request) {
            if (Worksheet::find($id)) {
                if ($worksheet) {
                    return $worksheet;
                }

                return response()->json(['message' => 'This worksheet does not belong to the logged in user !']);
            }

            return response()->json(['message' => 'This worksheet does not exist !']);
        }

        return $request;
    }
}
