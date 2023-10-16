<?php

namespace App\Core;

use App\Core\Request;
use App\Core\Route;
use Exception;

class Router
{
    private $request;
    private $routes;
    private $currentRoute;

    const BASE_CONTROLLER = '\App\Controller\\';
    const BASE_MIDDLEWARE = '\App\Middleware\\';

    public function __construct()
    {
        $this->request = new Request();
        $this->routes = Route::routes();
        $this->currentRoute = $this->findRoute($this->request) ?? null;
        $this->runMiddleware();
    }

    private function runMiddleware()
    {
        if (isset($this->currentRoute['middleware'])) {
            $middlewares = $this->currentRoute['middleware'];
            foreach ($middlewares as $middleware) {
                $middlewareObj = new $middleware;
                $middlewareObj->handle();
            }
        }
    }

    public function findRoute(Request $request)
    {
        foreach ($this->routes as $route) {
            if (!in_array($request->method(), $route['methods'])) {
                return false;
            }

            if ($this->regexMatched($route)) {
                return $route;
            }
        }
        return null;
    }

    public function regexMatched($route)
    {
        global $request;
        $pattern = "/^" . str_replace(['/', '{', '}'], ['\/', '(?<', '>[-%\w]+)'], $route['uri']) . "$/";
        // var_dump($pattern);
        $result = preg_match($pattern, $this->request->uri(), $matches);
        if (!$result) {
            return false;
        }
        foreach ($matches as $key => $value) {
            if (!is_int($key)) {
                $request->addRouteParams($key, $value);
            }
        }

        return true;
    }

    public function invalidRequest(Request $request)
    {
        foreach ($this->routes as $route) {
            if (in_array($request->method(), $route['methods'])) {
                return true;
            }
        }
    }

    public function dispatch405()
    {
        dd('405 error | Invalid Request');
    }

    public function dispatch404()
    {
        header("HTTP/1.0 404 Not Found");
        view('errors.404');
        die();
    }


    public function run()
    {

        # 405 : Invalid request method
        if (!$this->invalidRequest($this->request)) {
            $this->dispatch405();
        }
        # 404 : page not found
        if (is_null($this->currentRoute)) {
            $this->dispatch404();
        }

        $this->dispatch($this->currentRoute);
    }

    private function dispatch($route)
    {
        $action = $route['action'];
        #call null to dispatch
        if ($action == null) {
            return;
        }

        # call closure to dispatch
        if (is_callable($action)) {
            $action();
        }

        # check if action is string convert to array
        if (is_string($action)) {
            $action = explode('@', $action);
        }
        # call new class
        $className = self::BASE_CONTROLLER . $action[0];
        $method = $action[1];
        if (!class_exists($className)) {
            throw new Exception($className . ' not found');
        }

        $controller = new $className();
        # call new method
        if (!method_exists($className, $action[1])) {

            throw new Exception($method . ' not found');
        }

        $controller->{$method}();
    }
}
