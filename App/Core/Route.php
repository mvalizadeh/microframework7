<?php

namespace App\Core;

class Route
{
    private static $routes = [];

    public static function add($methods, $uri, $action = null)
    {
        $methods = is_array($methods) ? $methods : [$methods];
        self::$routes[] = ['methods' => $methods, 'uri' => $uri, 'action' => $action];
    }

    public static function get($uri, $action = null)
    {
        self::add('/get', $uri, $action);
    }

    public static function post($uri, $action = null)
    {
        self::add('/post', $uri, $action);
    }

    public static function update($uri, $action = null)
    {
        self::add('/update', $uri, $action);
    }

    public static function delete($uri, $action = null)
    {
        self::add('/delete', $uri, $action);
    }

    public static function routes()
    {
        return self::$routes;
    }
}
