<?php

namespace App\Repositories;

use App\Models\DivisionMember;
use App\Models\Request;
use App\Models\Worksheet;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ManagerRepository extends BaseRepository
{

    public function getModel()
    {
        return Request::class;
    }

    public function getDivisionMembers($divisionId)
    {
        return
            DB::table('division_member')
                ->where('division_id', $divisionId)
                ->get();
    }

    public function getRequestSent($request)
    {
        $perPage = $request->per_page ?? config('common.default_per_page');

        $getRequestSent = $this->model;

        if (trim((string) $request->start_date) !== "") {
            $getRequestSent = $getRequestSent
                ->where('request_for_date', '>=', $request->start_date ?? "");
        }

        if (trim((string) $request->end_date) !== "") {
            $getRequestSent = $getRequestSent
                ->where('request_for_date', '<=', $request->end_date ?? "");
        }

        if (trim((string) $request->order_request_for_date) !== "") {
            $order = $request->order_request_for_date;
        } else {
            $order = 'desc';
        }

        $memberId = auth()->user()->id;
        $divisionId = DivisionMember::where('member_id', $memberId)->first();
        $divisionId = $divisionId->division_id;

        $members = self::getDivisionMembers($divisionId);

        $memberDivisions = [];

        foreach ($members as $member) {
            array_push($memberDivisions, $member->member_id);
        }

        $getRequestSent = $getRequestSent
            ->with('member')
            ->with('divisionMember')
            ->where('status', 0)
            ->whereIn('member_id', $memberDivisions)
            ->orderBy('request_for_date', $order)
            ->orderBy('id', $order)
            ->paginate($perPage, ['*'], 'page');

        foreach ($getRequestSent as $request) {
            $request->divisionMember = $request->member->division->first()->division_name;
        }
        return $getRequestSent;
    }


    public function confirm($request, $id)
    {
        $requestSent = $this->model->findOrFail($id);

        if ($requestSent->status === 0) {
            $status = $request->status;
            $comment = trim($request->comment);
            $memberId = $requestSent->member_id;
            $date = $requestSent->request_for_date;
            $requestType = $requestSent->request_type;
            $note = config('common.confirm');

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
                'message' => 'Confirm request successfully !'
            ], Response::HTTP_CREATED);
        } else {
            return response()->json(['error' => 'You are not authorized to process this request !'],
                Response::HTTP_FORBIDDEN);
        }
    }

    public function show($id)
    {
        $requests = $this->model
            ->where('id', $id)
            ->where('status', 0);

        if ($requests->exists()) {
            return $requests->first();
        } else {
            return response()->json(['error' => 'This request is not available yet !'], Response::HTTP_NO_CONTENT);
        }
    }
}
