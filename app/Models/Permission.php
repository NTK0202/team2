<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "permissions";
    public $fillable = ['title'];

    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'rolehaspermissions', 'permission_id', 'role_id');
    }

    public function hasRole()
    {
        return $this->hasMany(PermissionRole::class, 'permission_id');
    }
}
