<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worksheet extends Model
{
    use HasFactory;

    protected $table = "worksheets";

    public $timestamps = false;

    protected $fillable = [
        'id',
        'member_id',
        'work_date',
        'checkin',
        'checkin_original',
        'chekout',
        'checkout_original',
        'late',
        'early',
        'in_office',
        'ot_time',
        'work_time',
        'lack',
        'compensation',
        'paid_leave',
        'unpaid_leave',
        'note'
    ];
}
