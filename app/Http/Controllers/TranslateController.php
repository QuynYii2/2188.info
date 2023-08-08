<?php

namespace App\Http\Controllers;

use LanguageDetection\Language;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateController extends Controller
{
    private static $instance = null;
    private $translate;
    private $languageDetect;


    private function __construct()
    {
        $this->translate = new GoogleTranslate();
        $this->languageDetect = new Language(['en', 'vi', 'ja', 'zh-Hans', 'ko']);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new TranslateController();
        }
        return self::$instance;
    }

    public function translateText($str, $target)
    {
        if (is_numeric($str)) {
            return $str;
        }
        $this->translate->setSource($this->detectLanguage($str));
        $this->translate->setTarget($target);

        return $this->translate->translate($str);
    }

    public function detectLanguage($str)
    {
        $arrLang = $this->languageDetect->detect($str)->bestResults()->close();
        if (count($arrLang) != 0) {
            $langDetect = array_keys($arrLang)[0];
            if ($langDetect == 'zh-CN') {
                $langDetect = 'zh';
            }
            return $langDetect;
        }
        return '';
    }


    function getCurrentCountryCode()
    {
        $currentLocale = app()->getLocale();

        $localeToCountryMap = [
            'kr' => 'ko',
            'cn' => 'zh-CN',
            'vi' => 'vi',
            'jp' => 'ja'
        ];

        if (isset($localeToCountryMap[$currentLocale])) {
            return $localeToCountryMap[$currentLocale];
        } else {
            return 'en';
        }
    }

}
