<?php

namespace App\Helpers;

class Checkbox
{
    public static function get($checkbox)
    {
        if ($checkbox != null) return 1;
        else return 0;
    }
}
