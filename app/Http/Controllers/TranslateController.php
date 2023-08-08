<?php

namespace App\Http\Controllers;

use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateController extends Controller
{
    private static $instance = null;
    private $translate;

    private function __construct()
    {
        $this->translate = new GoogleTranslate();
        $this->translate->setTarget($this->getCurrentCountryCode());
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
        return $this->translate->translate($str);
    }

    function getCurrentCountryCode()
    {
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
    }

}
