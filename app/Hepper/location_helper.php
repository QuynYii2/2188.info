<?php


if (!function_exists('location')) {
    function locationHelper() {
        $locale = app()->getLocale();
        return $locale;
    }
}