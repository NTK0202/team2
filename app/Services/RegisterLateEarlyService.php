<?php

namespace App\Services;

use App\Models\MemberRequestQuota;
use App\Models\Request;
use App\Repositories\RegisterLateEarlyRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

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

    public function handleValueArray($request)
    {
        $dataRequest = array_map('trim', $request->all());
        $dataRequest['checkin'] = date('Y-m-d H:i', strtotime($dataRequest['request_for_date'] . $dataRequest['checkin']));
        $dataRequest['checkout'] = date('Y-m-d H:i', strtotime($dataRequest['request_for_date'] . $dataRequest['checkout']));
        $dataRequest['member_id'] = Auth::user()->id;
        $dataRequest['request_type'] = 4;

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

    public function createRequestLateEarly($request)
    {
        $dataRequest = $this->handleValueArray($request);
        return $this->repo->createRequestLateEarly($dataRequest);
    }

    public function updateRequestLateEarly($request)
    {
        $dataRequest = $this->handleValueArray($request);
        return $this->repo->updateRequestLateEarly($dataRequest);
    }

    public function validateParams($params): bool
    {
        return (bool) preg_match("/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/", $params);
    }

    public function getWorksheetByWorkDate($work_date)
    {
        if (Auth::user()->id && $this->validateParams($work_date)) {
            return $this->repo->getWorksheetByWorkDate($work_date);
        }

        return response()->json(["message" => "The param format is invalid !"], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
