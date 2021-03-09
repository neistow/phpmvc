<?php


namespace app\repositories;

use app\core\RepositoryBase;
use app\models\Actor;
use app\models\FilmActor;

class ActorsRepository extends RepositoryBase
{

    function getFilmActors($filmId)
    {
        $data = $this->db->queryMultiple("select a.id, a.first_name, a.last_name, r.name
                                          from actors a
                                                   left join film_actors fa on a.id = fa.actor_id
                                                   left outer join roles r on r.id = fa.role_id
                                          where fa.film_id = $filmId");
        if ($data == null) {
            return null;
        }

        $actors = [];
        foreach ($data as $key => $elem) {
            $actors[] = new FilmActor($elem[0], $elem[1], $elem[2], null);
        }

        return $actors;
    }

    function getAll()
    {
        $data = $this->db->queryMultiple("select * from phpmvc.actors");
        if ($data == null) {
            return null;
        }

        $actors = [];
        foreach ($data as $key => $elem) {
            $actors[] = new Actor($elem[0], $elem[1], $elem[2]);
        }

        return $actors;
    }

    function getById($id)
    {
        $data = $this->db->querySingle("select * from phpmvc.actors where id = $id");
        if ($data == null) {
            return null;
        }

        return new Actor($data[0], $data[1], $data[2]);
    }

    function update($entity)
    {
        return $this->db->query("update phpmvc.actors
                                 set first_name = '$entity->first_name', last_name = '$entity->last_name'
                                 where id = $entity->id");
    }

    function add($entity)
    {
        $this->db->query("insert into phpmvc.actors (first_name, last_name) values ('$entity->first_name', '$entity->last_name')");
    }

    function delete($id)
    {
        return $this->db->query("delete from phpmvc.actors where id = $id");
    }
}