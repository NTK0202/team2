<?php

namespace App\Services;

use App\Models\MemberRequestQuota;
use App\Models\Request;
use App\Repositories\RegisterLateEarlyRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RegisterLateEarlyService extends BaseService
{
    public function getModel()
    {
        return $this->model = Request::class;
    }

    public function getRepository(): string
    {
        return RegisterLateEarlyRepository::class;
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

    public function createRequestLateEarly($request)
    {
        $dataRequest = array_map('trim', $request->all());
        $dataRequest['member_id'] = Auth::user()->id;
        $dataRequest['request_type'] = 4;

        return $this->repo->createRequestLateEarly($dataRequest);
    }

    public function updateRequestLateEarly($request)
    {
        $dataRequest = array_map('trim', $request->all());
        return $this->repo->updateRequestLateEarly($dataRequest);
    }
}
