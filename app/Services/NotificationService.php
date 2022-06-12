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

    public function filter($request)
    {
        if (Auth::user()->id) {
            return $this->repo->filter($request);
        }
    }

    public function detail($noticeId)
    {
        if (Auth::user()->id && $this->validateParams($noticeId)) {
            return $this->repo->detail($noticeId);
        }

        return response()->json(["message" => "The param format is invalid !"], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function isFileAttachment($file)
    {
        if (Auth::user()->id == 1) {
            return true;
        } elseif (Auth::user()->id) {
            return $this->repo->isFileAttachment($file);
        }
    }
}
