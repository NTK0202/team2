<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisionMember extends Model
{
    use HasFactory;

    protected $table = "division_member";

    protected $fillable = [
        'member_id',
        'division_id',
    ];

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
}
