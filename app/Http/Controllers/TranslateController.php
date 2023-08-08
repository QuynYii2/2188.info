<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateController extends Controller
{
    private static $instance = null;
    private $translate;
    private $currentCountryCode;

    private function __construct()
    {
        $this->translate = new GoogleTranslate();
        $this->translate->setTarget($this->getCurrentCountryCode());
        $this->currentCountryCode = $this->getCurrentCountryCode();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new TranslateController();
        }
        return self::$instance;
    }

    public function translateText($str)
    {
        $cacheKey = 'translated_text_' . md5($str) . '_' . $this->currentCountryCode;

        return Cache::remember($cacheKey, null, function () use ($str) {
            return $this->translate->translate($str);
        });
    }

    function getCurrentCountryCode()
    {
        return Cache::remember('current_country_code', null, function () {
            $currentLocale = app()->getLocale();

            $localeToCountryMap = [
                'kr' => 'ko',
                'cn' => 'zh-CN',
                'vi' => 'vi',
            ];

            if (isset($localeToCountryMap[$currentLocale])) {
                return $localeToCountryMap[$currentLocale];
            } else {
                return 'en';
            }
        });
    }

}
