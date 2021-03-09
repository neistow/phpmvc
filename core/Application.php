<?php

namespace app\core;

use Exception;

class Application
{
    public $router;
    public $middlewares;

    public $request;
    public $response;

    public $database;

    public $user = null;
    public static $GlobalThis;

    function __construct()
    {
        self::$GlobalThis = $this;

        $this->request = new Request();
        $this->response = new Response();

        $this->router = new Router();
        $this->middlewares = array();

        $this->database = new Database("localhost", "phpmvc", "root", "1234");
    }

    public function registerMiddleware($middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function run()
    {
        try {
            $this->executeBeforeMiddleware();

            echo $this->router->resolve();

            $this->executeAfterMiddleware();
        } catch (Exception $ex) {
            echo $this->router->notFound();
        }
    }

    private function executeBeforeMiddleware()
    {
        foreach ($this->middlewares as $key => $middleware) {
            $middleware->ProcessBefore($this->request, $this->response);
        }
    }

    private function executeAfterMiddleware()
    {
        foreach ($this->middlewares as $key => $middleware) {
            $middleware->ProcessAfter($this->request, $this->response);
        }
    }
}