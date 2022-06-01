<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends BaseRepository
{
    public function getModel()
    {
        return Role::class;
    }

    public function addPermission($id, $request)
    {
        if ($this->model->find($id)) {
            $this->model->find($id)->permission()->attach($request['permission_id']);

            return response()->json(['message' => 'Add permissions to role successfully !']);
        }

        return response()->json(['message' => "This role does not exist"]);
    }

    public function updatePermission($id, $request)
    {
        if ($this->model->find($id)) {
            $this->model->find($id)->permission()->sync($request['permission_id']);

            return response()->json(['message' => 'Update permissions to role successfully !']);
        }

        return response()->json(['message' => "This role does not exist"]);
    }

    public function deletePermission($id, $request)
    {
        if ($this->model->find($id)) {
            $this->model->find($id)->permission()->detach();

            return response()->json(['message' => 'Delete permissions to role successfully !']);
        }

        return response()->json(['message' => "This role does not exist"]);
    }
}
