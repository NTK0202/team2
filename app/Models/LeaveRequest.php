<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $table = 'leave_quotas';
    protected $fillable = [
        'member_id',
        'year',
        'quota',
        'paid_leave',
        'unpaid_leave',
        'remain'
    ];
}
