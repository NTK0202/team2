<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService extends BaseService
{
    public function getRepository()
    {
        return RoleRepository::class;
    }

    public function validateParams($params)
    {
        return (preg_match("/^[0-9]*$/", $params)) ? true : false;
    }

    public function addPermission($id, $request)
    {
        if ($this->validateParams($id)) {
            return $this->repo->addPermission($id, $request);
        }

        return response()->json(['message' => 'The param format is invalid.']);
    }

    public function updatePermission($id, $request)
    {
        if ($this->validateParams($id)) {
            return $this->repo->updatePermission($id, $request);
        }

        return response()->json(['message' => 'The param format is invalid.']);
    }

    public function deletePermission($id, $request)
    {
        if ($this->validateParams($id)) {
            return $this->repo->deletePermission($id, $request);
        }

        return response()->json(['message' => 'The param format is invalid.']);
    }
}
