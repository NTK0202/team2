<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationRequest;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->middleware('auth:api');
        $this->notificationService = $notificationService;
    }

    public function getListNotification(NotificationRequest $request)
    {
        return response()->json([
            'official_notice' => $this->notificationService->filter($request),
            'per_page_config' => config('common.per_page'),
        ]);
    }

    public function getNoticeDetail($noticeId)
    {
        return response()->json(['notice_detail' => $this->notificationService->detail($noticeId)]);
    }

    public function downloadFileAttachment($file)
    {
        $isFileAttachment = $this->notificationService->isFileAttachment($file);

        if (Storage::exists($file)) {
            if (!$isFileAttachment) {
                return Storage::download($file);
            } else {
                return response()->json([
                    'message' => 'You do not have permission to this file !'
                ], Response::HTTP_FORBIDDEN);
            }
        } else {
            return response()->json([
                'message' => 'The file you requested does not exist !'
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
