<?php


namespace app\controllers;


use app\core\Application;
use app\core\ControllerBase;
use app\models\Film;
use app\repositories\FilmsRepository;

class FilmController extends ControllerBase
{
    public function FilmsList()
    {
        $filmsRepo = new FilmsRepository(Application::$GlobalThis->database);
        $films = $filmsRepo->getAll();

        return $this->renderPage('films', ["films" => $films]);
    }

    public function FilmsForm()
    {
        $body = $this->request->getBody();

        if (isset($body["id"])) {
            $filmsRepo = new FilmsRepository(Application::$GlobalThis->database);
            $film = $filmsRepo->getById($body["id"]);
            if ($film == null) {
                return $this->notFound("Film with such id doesn't exist!");
            }

            return $this->renderPage('films-form', ["film" => $film]);
        } else {
            return $this->renderPage('films-form');
        }
    }

    public function HandleFilmsForm()
    {
        $body = $this->request->getBody();

        $filmsRepo = new FilmsRepository(Application::$GlobalThis->database);

        if ($body["id"] != 0) {
            $film = $filmsRepo->getById($body["id"]);
            if ($film == null) {
                return $this->badRequest("Can't edit non existing film!");
            }

            $filmsRepo->update(new Film($body["id"], $body["name"], $body["date_released"], $body["rating"]));

            return $this->FilmsList();
        }

        $filmsRepo->add(new Film(0, $body["name"], $body["date_released"], $body["rating"]));
        return $this->FilmsList();
    }

    public function HandleFilmDelete()
    {
        $body = $this->request->getBody();

        $filmsRepo = new FilmsRepository(Application::$GlobalThis->database);
        $film = $filmsRepo->getById($body["id"]);
        if ($film == null) {
            return $this->badRequest("Can't delete non existing film!");
        }

        $filmsRepo->delete($body["id"]);

        return $this->FilmsList();
    }
}