<?php


namespace app\repositories;


use app\core\RepositoryBase;
use app\models\UserRole;

class UserRolesRepository extends RepositoryBase
{

    function getUserRoles($userId)
    {
        $data = $this->db->queryMultiple("select u.id, u.name from phpmvc.user_roles ur left join phpmvc.uroles u on u.id = ur.role_id where ur.user_id = $userId");
        if ($data == null) {
            return [];
        }

        $roles = [];
        foreach ($data as $key => $elem) {
            $roles[] = new UserRole($elem[0], $elem[1]);
        }

        return $roles;
    }

    function getAll()
    {
        // TODO: Implement getAll() method.
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