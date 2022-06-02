<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationRequest;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->middleware('auth:api');
        $this->notificationService = $notificationService;
    }

    public function getListNotification(NotificationRequest $request): JsonResponse
    {
        return response()->json(['official_notice' => $this->notificationService->filter($request)]);
    }

    public function getNoticeDetail($noticeId)
    {
        return response()->json(['notice_detail' => $this->notificationService->detail($noticeId)]);
    }
}
