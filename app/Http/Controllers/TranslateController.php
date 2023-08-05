<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateController extends Controller
{

    public function translateText($str)
    {
        $translate = new GoogleTranslate();
        $translate->setSource('vi');
        $translate->setTarget('ko');

        if (is_string($str)) {
            return $translate->translate($str);
        } else {
            return $str;
        }
    }
    public function translateMixedData($data)
    {
        $locale = app()->getLocale();
        if ($locale == 'vn') {
            $locale = 'vi';
        }

        $translate = new GoogleTranslate();
        $translate->setSource('vi');
        $translate->setTarget('ko');

        if (is_array($data)) {
            $translatedData = [];
            foreach ($data as $key => $value) {
                $translatedData[$key] = $this->translateText($value);
            }
            return $translatedData;
        } elseif (is_string($data)) {
            return $translate->translate($data);
        } else {
            return $data;
        }
    }

    public function translateRecursiveDeep(array $data)
    {
        $locale = app()->getLocale();
        if ($locale == 'vn') {
            $locale = 'vi';
        }

        $translatedArray = [];
        $translate = new GoogleTranslate();
        $translate->setSource('vi'); // Detect language automatically
        $translate->setTarget('ko');

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $translatedArray[$key] = $this->translateRecursiveDeep($value);
            } elseif (is_string($value)) {
                $translatedArray[$key] = $translate->translate($value);
            } else {
                $translatedArray[$key] = $value; // Preserve other types like numbers and objects
            }
        }

        return $translatedArray;
    }


}
