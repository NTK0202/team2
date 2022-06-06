<?php

namespace App\Repositories;

use App\Models\MemberRequestQuota;
use App\Models\Request;
use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RegisterForgetRepository extends BaseRepository
{
    protected $request;

    public function getModel()
    {
        return Request::class;
    }

    public function checkRequest($date)
    {
        return MemberRequestQuota::where('remain', '>', 0)
            ->where('month', Carbon::createFromFormat('Y-m-d', $date)->format('Y-m'))
            ->first();
    }

    public function storeMemberRequestQuota($value = [])
    {
        $memberRequestQuota = new MemberRequestQuota();
        $memberRequestQuota->fill($value);

        return $memberRequestQuota->save();
    }

    public function store($value = [])
    {
        $request = $this->model->where('request_for_date', 'like', $value['request_for_date'])
            ->where('member_id', Auth::user()->id)
            ->where('request_type', 1)
            ->doesntExist();

        if ($request) {
            $this->model->fill($value);
            $this->model->save();

            return response()->json(['message' => 'Create request forget successfully !']);
        }

        return response()->json(['message' => "Only 1 request of the same type is allowed per day !"]);
    }

    public function updateForget($value = [])
    {
        $request = $this->model->where('request_for_date', 'like', $value['request_for_date'])
            ->where('member_id', Auth::user()->id)
            ->where('request_type', 1)
            ->whereIn('status', [1, 2])
            ->doesntExist();

        if ($request) {
            $updateRequest = $this->model->where('request_for_date', 'like', $value['request_for_date'])
                ->where('member_id', Auth::user()->id)
                ->where('request_type', 1)
                ->first();

            if ($updateRequest) {
                $updateRequest->fill($value);
                $updateRequest->save();

                return response()->json(['message' => 'Update request forget successfully !']);
            }

            return response()->json(['message' => 'Request forget does not exist']);
        }

        return response()->json(['message' => "Your request is in confirmed or approved status, so it cannot be edited !"]);
    }
}
