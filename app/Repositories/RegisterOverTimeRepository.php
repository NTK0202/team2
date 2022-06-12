<?php

namespace App\Repositories;

use App\Models\MemberRequestQuota;
use App\Models\OverTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RegisterOverTimeRepository extends BaseRepository
{

    public function getModel(): string
    {
        return OverTime::class;
    }

    public function checkRequest($date)
    {
        return MemberRequestQuota::where('remain', '>', 0)
            ->where('month', Carbon::createFromFormat('Y-m-d', $date)->format('Y-m'))
            ->first();
    }

    public function createMemberRequestQuota($data = [])
    {
        $memberRequestQuota = new MemberRequestQuota();
        $memberRequestQuota->fill($data);

        return $memberRequestQuota->save();
    }

    public function createRequestOverTime($data = [])
    {
        $request = $this->model->where('request_for_date', 'like', $data['request_for_date'])
            ->where('member_id', Auth::user()->id)
            ->where('request_type', 5)
            ->doesntExist();

        if ($request) {
            $this->model->fill($data);
            $this->model->save();

            return response()->json(['message' => 'Register request late/early successfully !'],
                Response::HTTP_CREATED);
        }

        return response()->json(['message' => "Only one request of the same type is allowed per day !"],
            Response::HTTP_FORBIDDEN);

    }

    public function updateRequestOverTime($data)
    {
        $request = $this->model->where('request_for_date', 'like', $data['request_for_date'])
            ->where('member_id', Auth::user()->id)
            ->where('request_type', 5)
            ->whereIn('status', [1, 2])
            ->doesntExist();

        if ($request) {
            $updateRequest = $this->model->where('request_for_date', 'like', $data['request_for_date'])
                ->where('member_id', Auth::user()->id)
                ->where('request_type', 5)
                ->first();

            if ($updateRequest) {
                $updateRequest->fill($data);
                $updateRequest->save();

                return response()->json(['message' => 'Update request late/early successfully !'], Response::HTTP_OK);
            }

            return response()->json(['message' => 'Request late/early does not exist'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['message' => "Your request is in confirmed or approved status, so it cannot be edited !"],
            Response::HTTP_FORBIDDEN);
    }
}
