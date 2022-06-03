<?php

namespace App\Services;

use App\Repositories\RegisterLateEarlyRepository;

class RegisterLateEarlyService extends BaseService
{
    public function getRepository(): string
    {
        return RegisterLateEarlyRepository::class;
    }

    public function getRequestLateEarly($id)
    {
        return $this->repo->getRequestLateEarly($id);
    }
}
