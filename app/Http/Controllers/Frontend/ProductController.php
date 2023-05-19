<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Libraries\GeoIP;
use App\Traits\CountryCodeTrait;
use Illuminate\Http\Request;
use GuzzleHttp\Client;


class ProductController extends Controller
{
//    use CountryCodeTrait;
    public function product_by_local(Request $request){
        $local = '';
        if ($request->session()->has('locale')) {
            $local = $request->session()->get('locale');
            app()->setLocale($request->session()->get('locale'));
        } else {
            $client = new Client();
            $response = $client->get('https://ipinfo.io/ip');
            $ipAddress = trim((string) $response->getBody());
            $geoIp = new GeoIP();
            $locale = $geoIp->get_country_from_ip($ipAddress);
            if ($locale !== null && is_array($locale)) {
                $locale = $locale['countryCode'];
            } else {
                $locale = 'vi';
            }
        }
        return $local;
    }
}
