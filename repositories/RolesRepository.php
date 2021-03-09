<?php


namespace app\repositories;


use app\core\RepositoryBase;
use app\models\Role;

class RolesRepository extends RepositoryBase
{

    function getAll()
    {
        $data = $this->db->queryMultiple("select * from phpmvc.roles");
        if ($data == null) {
            return [];
        }

        $roles = [];
        foreach ($data as $key => $elem) {
            $roles[] = new Role($elem[0], $elem[1]);
        }

        return $roles;
    }

    function getById($id)
    {
        // TODO: Implement getById() method.
    }

    function update($entity)
    {
        // TODO: Implement update() method.
    }

    function add($entity)
    {
        // TODO: Implement add() method.
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }
}