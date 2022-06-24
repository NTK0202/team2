<?php

namespace App\Repositories;

use App\Models\LeaveRequest;
use App\Models\MemberRequestQuota;
use App\Models\Request;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RegisterLeaveRepository extends BaseRepository
{
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
            ->whereIn('request_type', [2, 3])
            ->doesntExist();

        if ($request) {
            $this->model->fill($value);
            $this->model->save();

            return response()->json(['message' => 'Create request leave successfully !']);
        }

        return response()->json(['message' => "Only 1 request of the same type is allowed per day !"]);
    }

    public function updateLeave($value = [])
    {
        $request = $this->model->where('request_for_date', 'like', $value['request_for_date'])
            ->where('member_id', Auth::user()->id)
            ->whereIn('request_type', [2, 3])
            ->whereIn('status', [1, 2])
            ->doesntExist();

        if ($request) {
            $updateRequest = $this->model->where('request_for_date', 'like', $value['request_for_date'])
                ->where('member_id', Auth::user()->id)
                ->whereIn('request_type', [2, 3])
                ->first();

            if ($updateRequest) {
                $updateRequest->fill($value);
                $updateRequest->save();

                return response()->json(['message' => 'Update request leave successfully !']);
            }

            return response()->json(['message' => 'Request leave does not exist']);
        }

        return response()->json(['message' => "Your request is in confirmed or approved status, so it cannot be edited !"]);
    }
}
