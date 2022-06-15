<?php

namespace App\Services;

use App\Models\Worksheet;
use App\Repositories\WorkSheetRepository;
use Illuminate\Support\Facades\Auth;

class WorkSheetService extends BaseService
{
    public function getRepository()
    {
        return WorkSheetRepository::class;
    }

    public function filter($request, $member_id)
    {
        return $this->repo->filter($request, $member_id);
    }

    public function find($id, $request = null)
    {
        return $this->repo->find($id, $request);
    }
}
