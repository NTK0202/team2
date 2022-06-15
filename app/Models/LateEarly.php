<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LateEarly extends Model
{

    use HasFactory;

    protected $table = 'requests';

    protected $fillable = [
        'member_id',
        'request_type',
        'request_for_date',
        'checkin',
        'checkout',
        'compensation_time',
        'compensation_date',
        'leave_all_day',
        'leave_start',
        'leave_end',
        'leave_time',
        'request_ot_time',
        'reason',
        'status',
        'manager_confirmed_status',
        'manager_confirmed_at',
        'manager_confirmed_comment',
        'admin_approved_status',
        'admin_approved_at',
        'admin_approved_comment',
        'error_count',
    ];
}
