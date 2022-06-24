<?php

namespace App\Services;

use App\Models\MemberRequestQuota;
use App\Models\Worksheet;
use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminService extends BaseService
{
    public function getRepository()
    {
        return AdminRepository::class;
    }

    public function getRequest($request) {
        return $this->repo->getRequest($request);
    }

    public function approve($request, $id)
    {
        return $this->repo->approve($request, $id);
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
