<?php

namespace App\Services;

use App\Models\MemberRequestQuota;
use App\Models\Request;
use App\Repositories\RegisterOverTimeRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RegisterOverTimeService extends BaseService
{

    public function getModel()
    {
        return $this->model = Request::class;
    }

    public function getRepository(): string
    {
        return RegisterOverTimeRepository::class;
    }

    public function handleValueArray($request)
    {
        $dataRequest = array_map('trim', $request->all());
        $dataRequest['checkin'] = date('Y-m-d H:i', strtotime($dataRequest['request_for_date'] . $dataRequest['checkin']));
        $dataRequest['checkout'] = date('Y-m-d H:i', strtotime($dataRequest['request_for_date'] . $dataRequest['checkout']));
        $dataRequest['member_id'] = Auth::user()->id;
        $dataRequest['request_type'] = 5;

        return $dataRequest;
    }

    public function checkRequest($date)
    {
        $dateRequest = Carbon::createFromFormat('Y-m-d', $date)->format('Y-m');
        $checkExistRequestQuota = MemberRequestQuota::where('month', $dateRequest)
            ->doesntExist();

        if ($checkExistRequestQuota) {
            $data = [
                'member_id' => Auth::user()->id,
                'month' => Carbon::createFromFormat('Y-m-d', $date)->format('Y-m')
            ];

            $this->repo->createMemberRequestQuota($data);
        }

        return $this->repo->checkRequest($date);
    }

    public function createRequestOverTime($request)
    {
        $dataRequest = $this->handleValueArray($request);
        return $this->repo->createRequestOverTime($dataRequest);
    }

    public function updateRequestOverTime($request)
    {
        $dataRequest = $this->handleValueArray($request);
        return $this->repo->updateRequestOverTime($dataRequest);
    }
}
