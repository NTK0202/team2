<?php

namespace App\Repositories;

use App\Models\Member;

class MemberRepository extends BaseRepository
{
    public function getModel()
    {
        return Member::class;
    }

    public function find($member_id)
    {
        return $this->model->find($member_id);
    }

    public function update($id, $value)
    {
        $result = $this->model->find($id);
        $result->fill($value->all());
        if ($value->has('avatar')) {
            $result->avatar = $value->file('avatar')->storeAs(
                'uploads/members/',
                uniqid() . $value->avatar->getClientOriginalName()
            );
        }

        if ($value->has('avatar_official')) {
            $result->avatar_official = $value->file('avatar_official')->storeAs(
                'uploads/members/',
                uniqid() . $value->avatar_official->getClientOriginalName()
            );
        }

        return $result->save();
    }
}
