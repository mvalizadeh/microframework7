<?php

namespace App\Core;

class Request
{

    private $params;
    private $method;

    public function __construct()
    {
        $this->params = $_REQUEST;
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function method()
    {
        return $this->method;
    }

    public function params()
    {
        return $this->params;
    }

    public function input($key)
    {
        return $this->params[$key] ?? null;
    }
}
