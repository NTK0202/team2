<?php

namespace App\Repositories;

use App\Models\Request;

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
}
