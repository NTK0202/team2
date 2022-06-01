<?php

namespace App\Repositories;

use App\Models\Worksheet;
use Carbon\Carbon;

class WorkSheetRepository extends BaseRepository
{
    public function getModel()
    {
        return Worksheet::class;
    }

    public function filter($request, $member_id)
    {
        $this->model = $this->model->find($member_id);

        if (trim((string)$request->start_date) !== "") {
            $this->model = $this->model
                ->where('work_date', '>=', $request->start_date ?? "");
        }

        if (trim((string)$request->end_date) !== "") {
            $this->model = $this->model
                ->where('work_date', '<=', $request->end_date ?? "");
        }

        if (trim((string)$request->work_date) !== "") {
            $this->model = $this->model->orderBy('work_date', $request->work_date);
        } else {
            $this->model = $this->model->orderBy('work_date', 'desc');
        }

        return $this->model->paginate(3, ['*'], 'page');
    }
}
