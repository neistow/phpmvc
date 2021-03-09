<?php


namespace app\controllers;


use app\core\Application;
use app\core\ControllerBase;
use app\models\FilmActor;
use app\repositories\ActorsRepository;
use app\repositories\FilmActorsRepository;
use app\repositories\FilmsRepository;
use app\repositories\RolesRepository;

class FilmActorsController extends ControllerBase
{
    function FilmActorsList()
    {
        $body = $this->request->getBody();

        $filmIdFilter = isset($body["film_id"]) ? $body["film_id"] : null;

        $filmActorRepo = new FilmActorsRepository(Application::$GlobalThis->database);

        if ($filmIdFilter == null) {
            $filmActors = $filmActorRepo->getAll();

            return $this->renderPage('film-actors', ["filmActors" => $filmActors]);
        }

        $filmActors = $filmActorRepo->getFilmActorsByFilmId($filmIdFilter);
        return $this->renderPage('film-actors', ["filmActors" => $filmActors]);
    }

    public function FilmActorsForm()
    {
        $body = $this->request->getBody();

        if (isset($body["film_id"]) && isset($body["actor_id"])) {
            $filmActorsRepo = new FilmActorsRepository(Application::$GlobalThis->database);
            $filmActor = $filmActorsRepo->getById([$body["film_id"], $body["actor_id"]]);
            if ($filmActor == null) {
                return $this->notFound("Such film actor doesn't exist");
            }

            $rolesRepo = new RolesRepository(Application::$GlobalThis->database);
            $roles = $rolesRepo->getAll();

            return $this->renderPage('film-actors-form', ["filmActor" => $filmActor, "roles" => $roles]);
        }

        return $this->badRequest("film_id and actor_id weren't provided");
    }

    public function FilmActorsFormCreate()
    {
        $actorsRepo = new ActorsRepository(Application::$GlobalThis->database);
        $filmsRepo = new FilmsRepository(Application::$GlobalThis->database);
        $rolesRepo = new RolesRepository(Application::$GlobalThis->database);

        $actors = $actorsRepo->getAll();
        $films = $filmsRepo->getAll();
        $roles = $rolesRepo->getAll();

        return $this->renderPage('film-actors-form-create', ["actors" => $actors, "films" => $films, "roles" => $roles]);
    }

    public function HandleFilmActorCreate()
    {
        $body = $this->request->getBody();

        if (isset($body["film_id"]) && isset($body["actor_id"])) {
            $filmActorsRepo = new FilmActorsRepository(Application::$GlobalThis->database);
            $filmActor = $filmActorsRepo->getById([$body["film_id"], $body["actor_id"]]);
            if ($filmActor != null) {
                return $this->badRequest("Such film actor already exists!");
            }

            $filmActorsRepo->add([$body["actor_id"], $body["film_id"], $body["role_id"]]);

            return $this->FilmActorsList();
        }

        return $this->badRequest("film_id and actor_id weren't provided");
    }

    public function HandleFilmActorEdit()
    {
        $body = $this->request->getBody();

        if (isset($body["film_id"]) && isset($body["actor_id"])) {
            $filmActorsRepo = new FilmActorsRepository(Application::$GlobalThis->database);
            $filmActor = $filmActorsRepo->getById([$body["film_id"], $body["actor_id"]]);
            if ($filmActor == null) {
                return $this->notFound("Such film actor doesn't exist");
            }

            $filmActorsRepo->update([$filmActor->film_id, $filmActor->actor_id, $body["role_id"]]);

            return $this->FilmActorsList();
        }

        return $this->badRequest("film_id and actor_id weren't provided");
    }

    public function HandleFilmActorDelete()
    {
        $body = $this->request->getBody();

        $filmActorsRepo = new FilmActorsRepository(Application::$GlobalThis->database);
        $film = $filmActorsRepo->getById([$body["film_id"], $body["actor_id"]]);
        if ($film == null) {
            return $this->badRequest("Can't delete non existing film actor!");
        }

        $filmActorsRepo->delete([$body["film_id"], $body["actor_id"]]);

        return $this->FilmActorsList();
    }
}