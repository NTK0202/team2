<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    use HasFactory;

    public $table = "permission_role";

    public $fillable = ['role_id','permission_id'];

    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'permission_role','id','permission_id');
    }
}
