<?php


namespace app\repositories;


use app\core\RepositoryBase;
use app\models\Film;

class FilmsRepository extends RepositoryBase
{

    function getAll()
    {
        $data = $this->db->queryMultiple("select * from phpmvc.films");
        if ($data == null) {
            return [];
        }

        $films = [];
        foreach ($data as $key => $elem) {
            $films[] = new Film($elem[0], $elem[1], $elem[2], $elem[3]);
        }

        return $films;
    }

    function getById($id)
    {
        $data = $this->db->querySingle("select * from phpmvc.films where id = $id");
        if ($data == null) {
            return null;
        }

        return new Film($data[0], $data[1], $data[2], $data[3]);
    }

    function update($entity)
    {
        return $this->db->query("update phpmvc.films
                                 set name = '$entity->name', date_released = '$entity->date_released', rating = $entity->rating
                                 where id = $entity->id");
    }

    function add($entity)
    {
        return $this->db->query("insert into phpmvc.films (name, date_released, rating) values ('$entity->name', '$entity->date_released', $entity->rating)");
    }

    function delete($id)
    {
        return $this->db->query("delete from phpmvc.films where id = $id");
    }
}