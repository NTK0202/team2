<?php

namespace App\Services;

use App\Repositories\ManagerRepository;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ManagerService extends BaseService
{

    public function getRepository()
    {
        return ManagerRepository::class;
    }

    public function getRequestSent($request)
    {
        return $this->repo->getRequestSent($request);
    }

    public function confirm($request, $id)
    {
        return $this->repo->confirm($request, $id);
    }

    public function validateParams($params): bool
    {
        return (bool) preg_match("/^[0-9]*$/", $params);
    }

    public function show($id)
    {
        if (Auth::user()->id && $this->validateParams($id)) {
            return $this->repo->show($id);
        }
        return response()->json(["message" => "The param format is invalid !"], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
