<?php

namespace App\Services;

use App\Repositories\MemberRepository;
use Illuminate\Support\Facades\Auth;

class MemberService extends BaseService
{
    public function getRepository()
    {
        return MemberRepository::class;
    }

    public function find($member_id,$request = null)
    {
        return $this->repo->find($member_id,$request);
    }

    public function update($member_id, $request)
    {
        return $this->repo->update($member_id, $request);
    }
}
