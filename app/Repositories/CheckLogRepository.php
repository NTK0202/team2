<?php

namespace App\Repositories;

use App\Models\CheckLog;
use Illuminate\Support\Carbon;

class CheckLogRepository extends BaseRepository
{
    public function getModel(): string
    {
        return CheckLog::class;
    }

    public function getTimeLogs($request, $member_id)
    {
        $object = $this->model
            ->select('id', 'checktime', 'date')
            ->where('member_id', $member_id)
            ->where('date', $request->date)
            ->get();

        foreach ($object as $unit) {
            $unit->checktime = Carbon::createFromFormat('Y-m-d H:i:s', $unit->checktime)->format('h:i');
        }

        return $object;
    }
}
