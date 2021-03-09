<?php


namespace app\repositories;


use app\core\RepositoryBase;
use app\models\FilmActor;

class FilmActorsRepository extends RepositoryBase
{

    function getAll()
    {
        $data = $this->db->queryMultiple("select fa.film_id, a.id, a.first_name, a.last_name, r.name
                                          from phpmvc.film_actors fa
                                          left join phpmvc.actors a on a.id = fa.actor_id
                                          left join phpmvc.roles r on r.id = fa.role_id");
        if ($data == null) {
            return [];
        }

        $filmActors = [];
        foreach ($data as $key => $elem) {
            $filmActors[] = new FilmActor($elem[0], $elem[1], $elem[2], $elem[3], $elem[4]);
        }

        return $filmActors;
    }

    function getFilmActorsByFilmId($filmId)
    {
        $data = $this->db->queryMultiple("select fa.film_id, a.id, a.first_name, a.last_name, r.name
                                          from phpmvc.film_actors fa
                                          left join phpmvc.actors a on a.id = fa.actor_id
                                          left join phpmvc.roles r on r.id = fa.role_id
                                          where fa.film_id = $filmId");
        if ($data == null) {
            return [];
        }

        $filmActors = [];
        foreach ($data as $key => $elem) {
            $filmActors[] = new FilmActor($elem[0], $elem[1], $elem[2], $elem[3], $elem[4]);
        }

        return $filmActors;
    }

    function getById($id)
    {
        $data = $this->db->querySingle("select fa.film_id, a.id, a.first_name, a.last_name, r.name 
                                        from phpmvc.film_actors fa 
                                        left join phpmvc.actors a on a.id = fa.actor_id
                                        left join phpmvc.roles r on r.id = fa.role_id
                                        where fa.film_id = $id[0] and fa.actor_id = $id[1]");
        if ($data == null) {
            return null;
        }

        return new FilmActor($data[0], $data[1], $data[2], $data[3], $data[4]);
    }

    function update($entity)
    {
        return $this->db->query("update phpmvc.film_actors
                                 set role_id = $entity[2]
                                 where film_id = $entity[0] and actor_id = $entity[1]");
    }

    function add($entity)
    {
        return $this->db->query("insert into phpmvc.film_actors (actor_id, film_id, role_id) values ($entity[0], $entity[1], $entity[2])");
    }

    function delete($id)
    {
        return $this->db->query("delete from phpmvc.film_actors fa where fa.film_id = $id[0] and fa.actor_id = $id[1]");
    }
}