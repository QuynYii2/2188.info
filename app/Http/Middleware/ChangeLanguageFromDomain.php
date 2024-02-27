<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChangeLanguageFromDomain
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
        $url = route('homepage');
        $parse = parse_url($url);
        $host = $parse['host'];
        if ($host == 'kr.2188.info') {
            Session::put('locale', 'kr');
        } elseif ($host == 'vn.2188.info') {
            Session::put('locale', 'vi');
        } elseif ($host == 'cn.2188.info') {
            Session::put('locale', 'cn');
        } elseif ($host == 'jp.2188.info') {
            Session::put('locale', 'jp');
        }
        return $next($request);
    }
}
