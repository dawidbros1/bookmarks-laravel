<?php

namespace App\Helper;

class Request
{
    public static function check($name)
    {
        if (isset($_REQUEST[$name]) && !empty($_REQUEST[$name])) return true;
        else return false;
    }

    public static function get($name)
    {
        if (Request::check($name) == true) return $_REQUEST[$name];
        else return null;
    }

    public static function checkArray($array)
    {
        foreach ($array as $name) {
            if (!isset($_REQUEST[$name]) || empty($_REQUEST[$name])) {
                return false;
            }
        }

        return true;
    }
}
