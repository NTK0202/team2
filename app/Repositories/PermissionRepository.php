<?php

namespace App\Repositories;

use App\Models\MemberRole;
use App\Models\Permission;
use App\Models\Role;

class PermissionRepository extends BaseRepository
{
    public function getModel()
    {
        return Permission::class;
    }

    public function get()
    {
        $roles = new Role();

        $role = MemberRole::select('member_role.id as id','members.full_name as nameMember', 'roles.title as nameRole')
            ->join('members', 'members.id', '=', 'member_role.member_id')
            ->join('roles', 'roles.id', '=', 'member_role.role_id')
            ->get();
            
        $permission = $roles->with('permission')->get();

        return response()->json(['role' => $role, 'permission' => $permission]);
    }
}
