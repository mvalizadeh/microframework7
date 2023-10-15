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

function view($path,$data=null)
{
    extract($data);
    $path = str_replace('.','/',$path);
    $viewFullPath = BASE_PATH . '/views/' . $path . '.php';
    require_once $viewFullPath;
}
