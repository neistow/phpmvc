<?php


namespace app\controllers;


use app\core\Application;
use app\core\ControllerBase;
use app\models\Actor;
use app\repositories\ActorsRepository;

class ActorsController extends ControllerBase
{
    public function ActorsList()
    {
        $actorsRepo = new ActorsRepository(Application::$GlobalThis->database);
        $actors = $actorsRepo->getAll();

        return $this->renderPage('actors', ["actors" => $actors]);
    }

    public function ActorsForm()
    {
        $body = $this->request->getBody();

        if (isset($body["id"])) {
            $actorsRepo = new ActorsRepository(Application::$GlobalThis->database);
            $actor = $actorsRepo->getById($body["id"]);
            if ($actor == null) {
                return $this->notFound("Actor with such id doesn't exist!");
            }

            return $this->renderPage('actors-form', ["actor" => $actor]);
        } else {
            return $this->renderPage('actors-form');
        }
    }

    public function HandleActorsForm()
    {
        $body = $this->request->getBody();

        $actorsRepo = new ActorsRepository(Application::$GlobalThis->database);

        if ($body["id"] != 0) {
            $actor = $actorsRepo->getById($body["id"]);
            if ($actor == null) {
                return $this->badRequest("Can't edit non existing actor!");
            }

            $actorsRepo->update(new Actor($body["id"], $body["first_name"], $body["last_name"]));

            return $this->ActorsList();
        }

        $actorsRepo->add(new Actor(0, $body["first_name"], $body["last_name"]));
        return $this->ActorsList();
    }

    public function HandleActorDelete()
    {
        $body = $this->request->getBody();

        $actors = new ActorsRepository(Application::$GlobalThis->database);
        $actor = $actors->getById($body["id"]);
        if ($actor == null) {
            return $this->badRequest("Can't delete non existing actor!");
        }

        $actors->delete($body["id"]);

        return $this->ActorsList();
    }
}