<?php

namespace App\Services;

class Base62
{
    public function encode(int $number): string
    {
        $alphabet = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

        if ($number == 0) return "0";

        $result = "";

        while ($number > 0)
        {
            $remainder = $number % 62;
            $result = $alphabet[$remainder] . $result;
            $number = intdiv($number, 62);
        }

        return $result;
    }
}