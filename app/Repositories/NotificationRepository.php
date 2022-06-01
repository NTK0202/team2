<?php

namespace App\Repositories;

use App\Models\Notification;

class NotificationRepository extends BaseRepository
{
    public function getModel(): string
    {
        return Notification::class;
    }

    public function filter($request)
    {
        if (trim((string) $request->order_published_date) !== "") {
            $order = $request->order_published_date;
        } else {
            $order = 'desc';
        }

        return $this->model
            ->select('id', 'subject', 'created_by', 'published_to', 'published_date', 'attachment')
            ->with('author')
            ->orderBy('published_date', $order)
            ->paginate(5, ['*'], 'page');
    }

    public function detail($noticeId)
    {
        $notifications = $this->model
            ->where('id', $noticeId)
            ->with('division')
            ->first();

        return $notifications;
    }
}
