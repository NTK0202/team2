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
        return $this->model
            ->where('member_id', $member_id)
            ->where('date', $request->date)
            ->get();
    }
}
