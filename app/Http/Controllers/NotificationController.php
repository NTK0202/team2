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

    public function getListNotification(NotificationRequest $request, $member_id): JsonResponse
    {
        return response()->json(['official_notice' => $this->notificationService->filter($request ,$member_id)]);
    }
}
