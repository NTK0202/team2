<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
    ];

    public function hasPermission()
    {
        return $this->hasMany(PermissionRole::class, 'role_id');
    }

    public function hasUser()
    {
        return $this->hasMany(MemberRole::class, 'role_id');
    }

    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }
}
