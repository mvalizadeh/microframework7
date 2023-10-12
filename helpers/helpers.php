<?php

function url($route)
{
    return $_ENV['SITE_URL'] . $route;
}

function asset($route)
{
    return $_ENV['SITE_URL'] . '/assets' . $route;
}


function dd($var)
{
    echo '<pre>';
    var_dump($var);
    exit;
}
