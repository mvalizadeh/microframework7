<?php

namespace App\Core;

class Request
{

    private $params;
    private $method;
    private $uri;

    public function __construct()
    {
        $this->params = $_REQUEST;
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        $this->uri = str_replace('/micro7','',strtok($_SERVER['REQUEST_URI'], '?'));
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

    public function uri()
    {
        return $this->uri;
    }
}
