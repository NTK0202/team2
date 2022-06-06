<?php

namespace App\Repositories;

use App\Models\OT;

class RegisterOTRepository extends BaseRepository
{

    public function getModel(): string
    {
        return OT::class;
    }

}
