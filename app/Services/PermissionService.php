<?php

namespace App\Services;

use App\Repositories\PermissionRepository;

class PermissionService extends BaseService
{
    public function getRepository()
    {
        return PermissionRepository::class;
    }

    public function get()
    {
        return $this->repo->get();
    }

    public function validateParams($params)
    {
        return (preg_match("/^[0-9]*$/", $params)) ? true : false;
    }

    public function delete($id)
    {
        if ($this->validateParams($id)) {
            return $this->repo->delete($id);
        }

        return response()->json(["message" => "The param format is invalid."]);
    }
}
