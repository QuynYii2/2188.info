<?php

namespace App\Services;

class Utils
{
    public function generateString()
    {
        $chars = "abcdefghijkmnopqrstuvwxyz0123456789ABCDEFGHIJKMNOPQRSTUVWXYZ";
        srand((double)microtime() * 1000000);
        $i = 0;
        $string = '';

        while ($i <= 10) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $string = $string . $tmp;
            $i++;
        }

        return $string;
    }
}