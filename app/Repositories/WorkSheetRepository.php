<?php

namespace App\Repositories;

use App\Models\Request;
use App\Models\Worksheet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class WorkSheetRepository extends BaseRepository
{
    public function getModel()
    {
        return Worksheet::class;
    }

    public function filter($request, $member_id)
    {
        $per_page = $request->per_page ?? config('default_per_page');
        $page = $request->page ?? 1;

        $this->model = $this->model->where('member_id', $member_id);

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

        return $this->model->paginate($per_page, ['*'], 'page', $page);
    }

    public function findRequest($date, $type)
    {
        return Request::where('member_id', Auth::user()->id)
            ->where('request_for_date', $date)
            ->where('request_type', $type)
            ->first();
    }

    public function find($id, $request = null)
    {
        $worksheet = $this->model->where('id', $id)
            ->where('member_id', Auth::user()->id)
            ->first();

        if ($this->model->find($id)) {
            if ($worksheet) {
                $findRequest = $this->findRequest($worksheet->work_date, $request->type);

                return (!$findRequest) ? $worksheet : $findRequest;
            }

            return response()->json(['message' => "You cannot access other people's worksheets"]);
        }

        return response()->json(['message' => 'This worksheet does not exist !']);
    }
}
