<?php

namespace App\Libraries;

use MaxMind\Db\Reader;

class GeoIP
{
    protected $reader;

    public function __construct()
    {
        $databaseFile = storage_path('/app/geoip/GeoLite2-Country.mmdb');
        $this->reader = new Reader($databaseFile);
    }

    public function get_country_from_ip($ip)
    {
        $record = $this->reader->get($ip);
        $countryCode = $record['country']['iso_code'];
        switch ($countryCode) {
            case 'KR':
                return 'kr';
            case 'JP':
                return 'ja';
            case 'CN':
                return 'zh-CN';
            default:
                return 'vi';
        }
    }
}
