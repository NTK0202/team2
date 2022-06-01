<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckLog extends Model
{
    use HasFactory;

    protected $table = "check_logs";

    protected $fillable = [
        'member_id',
        'checktime',
        'date',
    ];
}
