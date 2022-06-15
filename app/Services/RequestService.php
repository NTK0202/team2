<?php

namespace App\Services;

use App\Models\MemberRequestQuota;
use App\Models\Worksheet;
use App\Repositories\RequestRepository;

class RequestService extends BaseService
{
    public function getRepository()
    {
        return RequestRepository::class;
    }

    public function getRequestConfirm() {
        return $this->repo->getRequestConfirm();
    }

    public function approve($request, $id)
    {
        return $this->repo->approve($request, $id);
    }
}
