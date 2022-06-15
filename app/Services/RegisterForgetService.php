<?php

namespace App\Services;

use App\Models\MemberRequestQuota;
use App\Models\Request;
use App\Models\Worksheet;
use App\Repositories\RegisterForgetRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RegisterForgetService extends BaseService
{
    public function getModel()
    {
        return $this->model = Request::class;
    }

    public function getRepository()
    {
        return RegisterForgetRepository::class;
    }

    public function handleValueArray($request)
    {
        $valueRequest = array_map('trim', $request->all());
        $valueRequest['checkin'] = date('Y-m-d H:i', strtotime($valueRequest['request_for_date'] . $valueRequest['checkin']));
        $valueRequest['checkout'] = date('Y-m-d H:i', strtotime($valueRequest['request_for_date'] . $valueRequest['checkout']));
        $valueRequest['member_id'] = Auth::user()->id;
        $valueRequest['request_type'] = 1;
        $valueRequest['error_count'] = isset($valueRequest['error_count']) ? $valueRequest['error_count'] : 0;

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

    public function updateForget($request)
    {
        $dataRequest = $this->handleValueArray($request);
        return $this->repo->updateForget($dataRequest);
    }
}
