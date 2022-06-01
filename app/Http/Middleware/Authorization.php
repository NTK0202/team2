<?php

namespace App\Http\Middleware;

use App\Models\MemberRole;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        $role = Role::where('title', $roles)->first();
        $hasRole = MemberRole::where('role_id', $role->id)->pluck('member_id')->toArray();
        if (in_array(Auth::id(), $hasRole)) {
            return $next($request);
        } else {
            return response()->json(['status' => "You don't have access !"]);
        }
    }
}
