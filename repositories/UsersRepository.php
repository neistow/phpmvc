<?php


namespace app\repositories;


use app\core\RepositoryBase;
use app\models\User;

class UsersRepository extends RepositoryBase
{
    function getByEmail($email)
    {
        $data = $this->db->querySingle("select * from phpmvc.users where email = '$email'");
        if ($data == null) {
            return null;
        }

        return new User($data[0], $data[1], $data[2]);
    }

    function getAll()
    {
        $data = $this->db->queryMultiple("select * from phpmvc.users");
        if ($data == null) {
            return null;
        }

        $users = [];
        foreach ($data as $key => $elem) {
            $users[] = new User($elem[0], $elem[1], $elem[2]);
        }

        return $users;
    }

    function getById($id)
    {
        $data = $this->db->querySingle("select * from phpmvc.users where id = $id");
        if ($data == null) {
            return null;
        }

        return new User($data[0], $data[1], $data[2]);
    }

    function update($entity)
    {
        // TODO: Implement update() method.
    }

    function add($entity)
    {
        return $this->db->query("insert into phpmvc.users (email, password_hash) values ('$entity->email', '$entity->password_hash')");
    }

    function delete($id)
    {
        return $this->db->query("delete from phpmvc.users where id = $id");
    }
}