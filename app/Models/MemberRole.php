<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberRole extends Model
{
    use HasFactory;

    protected $table = "member_role";

    protected $fillable = [
        'member_id',
        'role_id',
    ];

    public $timestamps = false;

    public function memberId()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

}
