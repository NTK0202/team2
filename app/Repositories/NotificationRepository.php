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
        $perPage = $request->per_page ?? config('common.default_per_page');

        if (trim((string) $request->order_published_date) !== "") {
            $order = $request->order_published_date;
        } else {
            $order = 'desc';
        }

        if (auth()->user()->memberId->role_id == 1) {
            return $this->model
                ->with('author')
                ->orderBy('published_date', $order)
                ->orderBy('subject', $order)
                ->paginate($perPage, ['*'], 'page');
        } else {
            $memberId = auth()->user()->id;
            $divisionId = DivisionMember::where('member_id', $memberId)->first();
            $divisionId = $divisionId->division_id;

            return $this->model
                ->with('author')
                ->orderBy('published_date', $order)
                ->orderBy('subject', $order)
                ->whereJsonContains('published_to', [$divisionId])
                ->orwhereJsonContains('published_to', ["all"])
                ->paginate($perPage, ['*'], 'page');
        }
    }

    public function detail($noticeId)
    {
        if (auth()->user()->memberId->role_id == 1) {
            return $this->model
                ->where('id', $noticeId)
                ->with('author')
                ->first();
        } else {
            return $this->model
                ->with('author')
                ->where('id', $noticeId)
                ->where(function ($query) {
                    $memberId = auth()->user()->id;
                    $divisionId = DivisionMember::where('member_id', $memberId)->first();
                    $divisionId = $divisionId->division_id;

                    $query
                        ->whereJsonContains('published_to', [$divisionId])
                        ->orwhereJsonContains('published_to', ["all"]);
                })
                ->first();
        }
    }

    public function isFileAttachment($file)
    {
        $memberId = auth()->user()->id;
        $divisionId = DivisionMember::where('member_id', $memberId)->first();
        $divisionId = $divisionId->division_id;

        return $this->model
            ->where('attachment', $file)
            ->with('author')
            ->whereJsonContains('published_to', [$divisionId])
            ->orwhereJsonContains('published_to', ["all"])
            ->doesntExist();
    }
}
