<?php

namespace App\Repositories;

use App\Models\Division;
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
            ->with('author')
            ->orderBy('published_date', $order)
            ->paginate(5, ['*'], 'page');
    }

    public function detail($noticeId)
    {
        $notification = $this->model
            ->where('id', $noticeId)
            ->with('author')
            ->first();
        $divisionName = [];
        foreach ($notification->published_to as $published){
            array_push($divisionName, $published->division_name);
        }

        $notification->published_to == json_encode($divisionName);

        return $notification;
    }
}
