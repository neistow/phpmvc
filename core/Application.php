<?php

namespace app\core;

class Application
{
    public $router;
    public $request;
    public $response;

    public static $GlobalThis;

    function __construct()
    {
        self::$GlobalThis = $this;

        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router();
    }

    function run()
    {
        echo $this->router->resolve();
    }
}