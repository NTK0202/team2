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
        $order = 'desc';

        if (trim((string)$request->order_published_date) !== "") {
            $order = $request->order_published_date;
        } else {
            $order = 'desc';
        }

        $object = $this->model
            ->select('id', 'subject', 'created_by', 'published_to', 'published_date', 'attachment')
            ->orderBy('published_date', $order)
            ->paginate(5, ['*'], 'page');

        foreach ($object as $unit) {
            $unit->created_by = $unit->memberFullName->full_name;

            unset($unit->memberFullName);
        }

        return $object;
    }

}
