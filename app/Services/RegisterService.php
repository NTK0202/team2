<?php

namespace App\Services;

use App\Repositories\RegisterRepository;

class RegisterService extends BaseService
{
    public function getRepository()
    {
        return RegisterRepository::class;
    }

    public function createForget($request)
    {
        return $this->repo->storeForget($request->all());
    }

    public function findRequest($id, $type)
    {
        return $this->repo->findRequest($id, $type);
    }
}
