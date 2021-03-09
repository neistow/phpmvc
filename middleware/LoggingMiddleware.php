<?php


namespace app\middleware;

use app\core\MiddlewareBase;

class LoggingMiddleware extends MiddlewareBase
{
    public function processBefore($request, $response)
    {
        $path = $request->getPath();
        $this->log("Processing request for path: $path");
    }

    public function processAfter($request, $response)
    {
        $path = $request->getPath();
        $this->log("Finished processing request for path: $path");
    }

    private function log($msg)
    {
        $timestamp = date('Y-m-d H:i:s');
        $msg = "$timestamp | $msg";
        file_put_contents('../logs.txt', $msg . PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}