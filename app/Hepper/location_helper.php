<?php


if (!function_exists('location')) {
    function locationHelper() {
        $locale = 'kr';
        return $locale;
    }
    function locationPermissionHelper() {
        $locale = 'kr';
        if ($locale == 'kr') {
            $locationPermission = 'ko';
        }
        elseif ($locale == 'vi'){
            $locationPermission = 'vi';
        }
        elseif ($locale == 'cn'){
            $locationPermission = 'zh-CN';
        }
        elseif ($locale == 'jp'){
            $locationPermission = 'ja';
        }
        else {
            $locationPermission = 'en';
        }

        return $locationPermission;
    }
}
