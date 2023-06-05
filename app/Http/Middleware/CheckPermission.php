<?php

namespace App\Http\Middleware;

use App\Enums\PermissionUserStatus;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle( $value, Request $request, Closure $next)
    {
        $permissionUsers = DB::table('permissions')
            ->join('permission_user', 'permission_user.permission_id', '=', 'permissions.id')
            ->where([['permission_user.user_id', Auth::user()->id], ['permission_user.status', PermissionUserStatus::ACTIVE]])
            ->select('permissions.*')
            ->get();

        foreach ($permissionUsers as $permissionUser) {
            if (auth()->check() && $permissionUser->name === $value) {
                return $next($request);
            }
        }
        abort(403, 'Unauthorized');
    }
}