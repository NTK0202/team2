<?php

namespace App\Services;

use App\Repositories\RegisterOTRepository;

class RegisterOTService extends BaseService
{

    public function getRepository(): string
    {
        return RegisterOTRepository::class;
    }

    public function getRequestOT($id)
    {
        return $this->repo->getRequestOT($id);
    }

    public function createRequestOT($request)
    {
        return $this->repo->createRequestOT($request->all());
    }

    public function updateRequestOT($request, $id)
    {
        return $this->repo->updateRequestOT($request->all(), $id);
    }
}
