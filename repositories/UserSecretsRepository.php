<?php


namespace app\repositories;


use app\core\RepositoryBase;

class UserSecretsRepository extends RepositoryBase
{

    function getSecretByUserId($userId)
    {
        return $this->db->querySingle("select * from phpmvc.user_secrets where user_id = $userId");
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
        return $this->db->query("insert into phpmvc.user_secrets (secret, user_id) values ('$entity[0]', $entity[1])");
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }
}