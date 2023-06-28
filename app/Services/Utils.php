<?php

namespace App\Services;

class Utils
{
    public function generateString()
    {
        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        srand((double)microtime() * 1000000);
        $i = 0;
        $string = '';

        while ($i <= 6) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $string = $string . $tmp;
            $i++;
        }

        return $string;
    }

    public function generateNumber()
    {
        $chars = "0123456789";
        srand((double)microtime() * 1000000);
        $i = 0;
        $string = '';

        while ($i <= 6) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $number = $string . $tmp;
            $i++;
        }

        return $number;
    }
}