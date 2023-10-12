<?php

namespace App\Utilities;


class Asset{

    public static function asset($route)
    {
    return $_ENV['SITE_URL'] . '/assets' . $route;
    }

    public static function css($route)
    {
    return $_ENV['SITE_URL'] . '/assets/css' . $route;
    }
}