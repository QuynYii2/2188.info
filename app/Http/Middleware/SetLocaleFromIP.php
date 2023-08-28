<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use MaxMind\Db\Reader;
use GeoIp2\Record\Location;
class SetLocaleFromIP
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
        $ipAddress = $request->ip();
//        $locale = $this->getLocaleFromIP($ipAddress);
        $locale = 'kr';
        app()->setLocale($locale);

        return $next($request);
    }

    protected function getLocaleFromIP($ipAddress)
    {
        $reader = new Reader(storage_path('app/geoip/GeoLite2-Country.mmdb'));
            $country = $reader->get_country_from_ip($ipAddress);
//        $countryCode = $country['country']['iso_code'];
        $countryCode = 'KR';

        switch ($countryCode) {
            case 'KR':
                return 'ko';
            case 'JP':
                return 'ja';
            case 'CN':
                return 'zh-CN';
            default:
                return 'kr';
        }
    }
}
