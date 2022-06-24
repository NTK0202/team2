<?php

namespace App\Services;

use App\Models\MemberRequestQuota;
use App\Repositories\RegisterLeaveRepository;
use App\Services\BaseService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RegisterLeaveService extends BaseService
{
    public function getRepository()
    {
        return RegisterLeaveRepository::class;
    }

    public function countLeaveTime($leave_start, $leave_end)
    {
        $leaveStartArr = explode(':', $leave_start);
        $leaveEndArr = explode(':', $leave_end);

        $leaveHours = $leaveEndArr[0] - $leaveStartArr[0];
        $leaveMinutes = $leaveEndArr[1] - $leaveStartArr[1];

        return Carbon::parse($leaveHours . ":" . $leaveMinutes)->format("H:i");
    }

    public function handleValueArray($request)
    {
        $valueRequest = array_map('trim', $request->all());
        $valueRequest['leave_all_day'] = isset($valueRequest['leave_all_day']) ? 1 : 0;
        $valueRequest['checkin'] = date('Y-m-d H:i', strtotime($valueRequest['request_for_date'] . $valueRequest['checkin']));
        $valueRequest['checkout'] = date('Y-m-d H:i', strtotime($valueRequest['request_for_date'] . $valueRequest['checkout']));
        if ($valueRequest['leave_all_day'] == 1) {
            $valueRequest['leave_start'] = "";
            $valueRequest['leave_end'] = "";
        } else {
            $valueRequest['leave_time'] = $this->countLeaveTime($valueRequest['leave_start'], $valueRequest['leave_end']);
        }

        $valueRequest['member_id'] = Auth::user()->id;
        $valueRequest['request_type'] = $valueRequest['paid'];

        return $valueRequest;
    }

    public function create($request)
    {
        $dataRequest = $this->handleValueArray($request);
        return $this->repo->store($dataRequest);
    }

    public function checkRequest($date)
    {
        $dateRequest = Carbon::createFromFormat('Y-m-d', $date)->format('Y-m');
        $checkExistRequestQuota = MemberRequestQuota::where('month', $dateRequest)
            ->doesntExist();

        if ($checkExistRequestQuota) {
            $value = [
                'member_id' => Auth::user()->id,
                'month' => Carbon::createFromFormat('Y-m-d', $date)->format('Y-m')
            ];

            $this->repo->storeMemberRequestQuota($value);
        }

        return $this->repo->checkRequest($date);
    }

    public function updateLeave($request)
    {
        $dataRequest = $this->handleValueArray($request);
        return $this->repo->updateLeave($dataRequest);
    }
}
