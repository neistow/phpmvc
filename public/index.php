<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\HomeController;
use app\core\Application;

$app = new Application();

$app->router->mapGet("/", ["controller" => HomeController::class, "method" => 'Index']);

$app->run();