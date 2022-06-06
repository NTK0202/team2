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

                return response()->json(['message' => 'You can not view other people worksheet !']);
            }

            return response()->json(['message' => 'This worksheet does not exist !']);
        }

        return $request;
    }

    public function createRequestLateEarly($data = [])
    {
        $data = [
            'member_id' => Auth::user()->id,
            'request_type' => 4,
        ];

        $this->model->fill($data);

        return $this->model->save();
    }

    public function updateRequestLateEarly($data, $id)
    {
        $request = $this->model->find($id);
        $data = [
            'member_id' => Auth::user()->id,
            'request_type' => 4,
        ];

        $request->fill($data);

        return $request->save();
    }
}
