<?php

namespace App\Repositories;

use App\Models\Request;
use App\Models\Worksheet;
use Illuminate\Support\Facades\Auth;

class RegisterRepository extends BaseRepository
{
    protected $request;

    public function getModel()
    {
        return Request::class;
    }

    public function findRequest($id, $type)
    {
        $worksheet = Worksheet::where('id', $id)
            ->where('member_id', Auth::user()->id)
            ->first();

        $request = $this->model
            ->where('member_id', Auth::user()->id)
            ->where('request_for_date', 'like', $worksheet->work_date)
            ->where('request_type', $type);

        if (!$request->first()) {
            if (Worksheet::find($id)) {
                if ($worksheet) {
                    return $worksheet;
                }

                return response()->json(['message' => 'This worksheet does not belong to the logged in user !']);
            }

            return response()->json(['message' => 'This worksheet does not exist !']);
        }

        return $request->first();
    }

    public function storeForget($value = [])
    {
        $value['member_id'] = Auth::user()->id;
        $value['request_type'] = 1;
        $this->model->fill($value);

        return $this->model->save();
    }
}
