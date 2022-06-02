<?php

namespace App\Repositories;

use App\Models\Division;
use App\Models\DivisionMember;
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

        if (auth()->user()->memberId->role_id == 1) {
            return $this->model
                ->with('author')
                ->orderBy('published_date', $order)
                ->paginate(5, ['*'], 'page');
        } else {
            $memberId = auth()->user()->id;
            $divisionId = DivisionMember::where('member_id', $memberId)->first();
            $divisionId = $divisionId->division_id;

            return $this->model
                ->with('author')
                ->orderBy('published_date', $order)
                ->whereJsonContains('published_to', [$divisionId])
                ->orwhereJsonContains('published_to', ["all"])
                ->paginate(5, ['*'], 'page');
        }
    }

    public function detail($noticeId)
    {
        $notification = $this->model
            ->where('id', $noticeId)
            ->with('author')
            ->first();

        return $notification;
    }
}
