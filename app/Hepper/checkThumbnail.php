<?php

if (!function_exists('checkThumbnail')) {
    function checkThumbnail($thumbnail)
    {
        if (!str_contains($thumbnail, 'http')) {
            $thumbnail = asset('storage/' . $thumbnail);
        }

        return $thumbnail;
    }
}