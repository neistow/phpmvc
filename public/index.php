<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\ActorsController;
use app\controllers\FilmActorsController;
use app\controllers\FilmController;
use app\controllers\HomeController;
use app\core\Application;
use app\middleware\GuardMiddleware;


$app = new Application();

$app->router->mapGet("/", ["controller" => HomeController::class, "method" => 'Index']);

$app->router->mapGet("/register", ["controller" => HomeController::class, "method" => 'Register']);
$app->router->mapPost("/register", ["controller" => HomeController::class, "method" => 'HandleRegister']);

$app->router->mapGet("/login", ["controller" => HomeController::class, "method" => 'Login']);
$app->router->mapPost("/login", ["controller" => HomeController::class, "method" => 'HandleLogin']);

$app->router->mapGet("/admin", ["controller" => HomeController::class, "method" => 'Admin']);

$app->router->mapGet("/films", ["controller" => FilmController::class, "method" => 'FilmsList']);
$app->router->mapGet("/films/edit", ["controller" => FilmController::class, "method" => 'FilmsForm']);
$app->router->mapPost("/films/edit", ["controller" => FilmController::class, "method" => 'HandleFilmsForm']);
$app->router->mapPost("/films/delete", ["controller" => FilmController::class, "method" => 'HandleFilmDelete']);

$app->router->mapGet("/actors", ["controller" => ActorsController::class, "method" => 'ActorsList']);
$app->router->mapGet("/actors/edit", ["controller" => ActorsController::class, "method" => 'ActorsForm']);
$app->router->mapPost("/actors/edit", ["controller" => ActorsController::class, "method" => 'HandleActorsForm']);
$app->router->mapPost("/actors/delete", ["controller" => ActorsController::class, "method" => 'HandleActorDelete']);

$app->router->mapGet("/film-actors", ["controller" => FilmActorsController::class, "method" => 'FilmActorsList']);
$app->router->mapGet("/film-actors/edit", ["controller" => FilmActorsController::class, "method" => 'FilmActorsForm']);
$app->router->mapGet("/film-actors/create", ["controller" => FilmActorsController::class, "method" => 'FilmActorsFormCreate']);
$app->router->mapPost("/film-actors/create", ["controller" => FilmActorsController::class, "method" => 'HandleFilmActorCreate']);
$app->router->mapPost("/film-actors/edit", ["controller" => FilmActorsController::class, "method" => 'HandleFilmActorEdit']);
$app->router->mapPost("/film-actors/delete", ["controller" => FilmActorsController::class, "method" => 'HandleFilmActorDelete']);

$guard = new GuardMiddleware();
$guard->addGuard("/admin", "get");

$guard->addGuard("/films/edit", "get");
$guard->addGuard("/films/edit", "post");
$guard->addGuard("/films/delete", "post");

$guard->addGuard("/actors/edit", "get");
$guard->addGuard("/actors/edit", "post");
$guard->addGuard("/actors/delete", "post");

$guard->addGuard("/film-actors/edit", "get");
$guard->addGuard("/film-actors/create", "get");
$guard->addGuard("/film-actors/create", "post");
$guard->addGuard("/film-actors/edit", "post");
$guard->addGuard("/film-actors/delete", "post");

$app->registerMiddleware($guard);


$app->run();