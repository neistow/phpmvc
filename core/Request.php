<?php


namespace app\core;


class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] == null ? "/" : $_SERVER['REQUEST_URI'];

        $queryArgsPos = strpos($path, '?');
        if ($queryArgsPos === false) {
            return $path;
        }

        return substr($path, 0, $queryArgsPos);
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getBody()
    {
        return $this->getMethod() === 'get' ? $_GET : $_POST;
    }
}