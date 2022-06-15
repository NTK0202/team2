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

    public function storeLeaveRequest($value = [])
    {
        dd(date('Y-m',$value['request_for_date']));
        $dataRequest = [
            'member_id' => Auth::user()->id,
            'type' => 0,
            'year' => date('Y', $value['request_for_date']),
            'quota' => 1,
            'note' => $value['note'],
            'status' => 0
        ];

        $leaveRequestFind = LeaveRequest::where('member_id', Auth::user()->id)
            ->where('year', date('Y', $value['request_for_date']))
            ->first();
            dd($value['request_for_date']);
        if ($leaveRequestFind) {
            $leaveRequestFind->fill($value);

            return $leaveRequestFind->save();
        }

        $leaveRequest = new LeaveRequest();
        $leaveRequest->fill($dataRequest);

        return $leaveRequest->save();
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

            $this->storeLeaveRequest($value);

            return response()->json(['message' => 'Create request forget successfully !']);
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
                ->where('request_type', 2)
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
