<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleSellerOrAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $roles = $user->roles;
            $roleNames = $roles->pluck('name');

            if ($roleNames->contains('seller') || $roleNames->contains('super_admin')  ) {
                return $next($request);
            }
        }
        abort(403, 'Unauthorized');
    }
}
