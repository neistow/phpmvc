<?php


namespace app\core;


abstract class MiddlewareBase
{
    public abstract function processBefore($request, $response);
    public abstract function processAfter($request, $response);
}