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

    public function getTimeLogs($request)
    {
        if (Auth::user()->id) {
            $member_id = Auth::user()->id;
            return $this->repo->getTimeLogs($request, $member_id);
        }
    }
}
