<?php

namespace App\Services;

use App\Repositories\NotificationRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class NotificationService extends BaseService
{
    public function getRepository(): string
    {
        return NotificationRepository::class;
    }

    public function validateParams($params): bool
    {
        return (bool) preg_match("/^[0-9]*$/", $params);
    }

    public function filter($request ,$member_id)
    {
        if ($this->validateParams($member_id)) {
            if (Auth::user()->id == $member_id) {
                return $this->repo->filter($request);
            } else {
                return response()->json(["message" => "You cannot access other people's notice!"], Response::HTTP_FORBIDDEN);
            }
        } else {
            return response()->json(["message" => "The param format is invalid!"], Response::HTTP_NOT_FOUND);
        }
    }
}
