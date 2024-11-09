<?php

if (!function_exists('randomNumber')) {
    function randomNumber($length = 6)
    {
        $start = intval('1' . str_repeat(0, $length - 1));
        $stop = intval('9' . str_repeat(9, $length - 1));
        return mt_rand($start, $stop);
    }
}