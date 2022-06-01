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
        $memberId = auth()->user()->id;

        if (trim((string) $request->order_published_date) !== "") {
            $order = $request->order_published_date;
        } else {
            $order = 'desc';
        }

//        if (auth()->user()->memberId->role_id == 1) {
            return $this->model
                ->with('author')
                ->orderBy('published_date', $order)
                ->whereJsonContains('published_to', [5,6])
                ->paginate(5, ['*'], 'page');
//        } else {
//            $divisionId = DivisionMember::where('member_id', $memberId)->first();
//            $divisionId = $divisionId->member_id;
//
//            foreach ($publishedTo as $department) {
//                if ($department == $divisionId) {
//                    return Division::where('id', $department)->get();
//                }
//            }
//
//            return $this->model
//                ->with('author')
//                ->orderBy('published_date', $order)
//                ->where($memberId)
//                ->where('', 'like', $memberId)
//                ->paginate(5, ['*'], 'page');
//        }
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
