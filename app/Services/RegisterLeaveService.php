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

    public function handleValueArray($request)
    {
        $valueRequest = array_map('trim', $request->all());
        $valueRequest['leave_all_day'] = $valueRequest['leave_all_day'] ? $valueRequest['leave_all_day'] : 0;
        $valueRequest['member_id'] = Auth::user()->id;
        $valueRequest['request_type'] = $valueRequest['paid'] ? $valueRequest['paid'] : $valueRequest['unpaid'];

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
                'member_id' => Auth::user()->id
            ];

            $this->repo->storeMemberRequestQuota($value);
        }

        return $this->repo->checkRequest($date);
    }

    public function updateLeave()
    {
        # code...
    }
}
