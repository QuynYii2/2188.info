<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Frontend\HomeController;
use Auth;
use Closure;
use Illuminate\Http\Request;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $isAdmin = (new HomeController())->checkAdmin();
        if ($isAdmin == true) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
