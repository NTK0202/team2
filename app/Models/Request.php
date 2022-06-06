<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Request extends Model
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
        'error_count'
    ];

    public function setCheckinAttribute($value)
    {
        $this->attributes['checkin'] = date('Y-m-d H:i', strtotime($this->attributes['request_for_date'] . $value));
    }

    public function setCheckoutAttribute($value)
    {
        $this->attributes['checkout'] = date('Y-m-d H:i', strtotime($this->attributes['request_for_date'] . $value));
    }
}
