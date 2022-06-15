<?php

namespace App\Repositories;

use App\Models\Member;

class MemberRepository extends BaseRepository
{
    public function getModel()
    {
        return Member::class;
    }

    public function find($member_id,$request = null)
    {
        return $this->model->find($member_id);
    }

    public function update($id, $value)
    {
        $result = $this->model->find($id);
        $result->fill($value->all());

        return $result->save();
    }
}
