<?php

namespace app\core;

class Router
{
    private $routes = [];

    private $request;
    private $response;

    function __construct()
    {
        $this->request = Application::$GlobalThis->request;
        $this->response = Application::$GlobalThis->response;
    }

    public function mapGet($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function mapPost($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = Application::$GlobalThis->request->getPath();
        $method = Application::$GlobalThis->request->getMethod();

        if (!isset($this->routes[$method][$path])) {
            $this->response->setStatusCode(404);
            return $this->notFound();
        }

        $info = $this->routes[$method][$path];

        $controller = new $info["controller"];
        return call_user_func(array($controller, $info["method"]));
    }

    public function notFound()
    {
        $base = new ControllerBase();
        return call_user_func([$base, 'notFound'], 'Page was not found...');
    }
}