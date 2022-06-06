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

    public function create($request)
    {
        $valueRequest = array_map('trim', $request->all());
        $valueRequest['member_id'] = Auth::user()->id;
        $valueRequest['request_type'] = 1;
        return $this->repo->store($valueRequest);
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
        $valueRequest = array_map('trim', $request->all());
        return $this->repo->updateForget($valueRequest);
    }
}
