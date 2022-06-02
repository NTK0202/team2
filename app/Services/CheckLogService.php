<?php

namespace App\Services;

use App\Repositories\CheckLogRepository;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckLogService extends BaseService
{
    public function getRepository(): string
    {
        return CheckLogRepository::class;
    }

    public function validateParams($params): bool
    {
        return (bool) preg_match("/^[0-9]*$/", $params);
    }

    public function getTimeLogs($request, $member_id)
    {
        if ($this->validateParams($member_id)) {
            if (Auth::user()->id == $member_id) {
                return $this->repo->getTimeLogs($request, $member_id);
            } else {
                return response()->json(["message" => "You cannot access other people's time log!"], Response::HTTP_FORBIDDEN);
            }
        } else {
            return response()->json(["message" => "The param format is invalid!"], Response::HTTP_NOT_FOUND);
        }
    }
}
