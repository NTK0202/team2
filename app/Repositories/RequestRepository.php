<?php

namespace App\Repositories;

use App\Models\MemberRequestQuota;
use App\Models\Request;
use App\Models\Worksheet;

class RequestRepository extends BaseRepository
{

    public function getModel()
    {
        return Request::class;
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function confirm($request, $id)
    {
        $requestSent = $this->findOrFail($id);
        if ($requestSent->status === 0) {
            $status = $request->status;
            $comment = trim($request->comment);
            $memberId = $requestSent->member_id;
            $date = $requestSent->request_for_date;
            $requestType = $requestSent->request_type;
            $note = config('common.note_confirm');

            $worksheet = Worksheet::where('member_id', $memberId)->where('work_date', $date)->first();

            $data = [
                'status' => $status,
                'manager_confirmed_comment' => $comment,
                'manager_confirmed_at' => now(),
                'manager_confirmed_status' => 1,
            ];

            $this->update($id, $data);
            $worksheet->note = $note[$requestType];
            $worksheet->save();

            return response()->json([
                'status' => true,
                'code' => 201,
                'message' => 'Confirm request success!'
            ], 201);
        } else {
            return response()->json([
                'status' => false,
                'code' => 403,
                'error' => 'You are not authorized to process this request'
            ], 403);
        }
    }

    public function getRequestConfirm()
    {
        $requestConfirm = $this->model->where('status', 1)->get();
        return $requestConfirm;
    }

    public function approve($request, $id)
    {
        $requestConfirm = $this->findOrFail($id);
        if ($requestConfirm->status === 1) {
            $status = $request->status;
            $comment = trim($request->comment);

            $memberId = $requestConfirm->member_id;
            $checkIn = $requestConfirm->check_in;
            $checkOut = $requestConfirm->check_out;
            $date = $requestConfirm->request_for_date;
            $requestType = $requestConfirm->request_type;
            $note = config('common.note_approve');
            $errorCount = $requestConfirm->error_count;
            $month = date('Y-m', strtotime($date));

            $worksheet = Worksheet::where('member_id', $memberId)->where('work_date', $date)->first();

            $data = [
                'status' => $status,
                'manager_confirmed_comment' => $comment,
                'manager_confirmed_at' => now(),
                'manager_confirmed_status' => 1,
            ];

            $this->update($id, $data);
            if ($status === 2) {
                $worksheet->note = $note[$requestType];
                $worksheet->save();
                if ($errorCount != 0) {
                    $requestQuota = MemberRequestQuota::where('member_id', $memberId)->where('month', $month)->first();
                    $requestQuota->remain = $requestQuota->remain + 1;
                    $requestQuota->save();
                }
            } else {
                $worksheet->note = null;
                $worksheet->save();
            }

            return response()->json([
                'status' => true,
                'code' => 201,
                'message' => 'Confirm request success!'
            ], 201);
        } else {
            return response()->json([
                'status' => false,
                'code' => 403,
                'error' => 'You are not authorized to process this request'
            ], 403);
        }
    }
}
