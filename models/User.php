<?php


namespace app\models;


class User
{
    public $id;
    public $email;
    public $password_hash;
    public $roles = null;

    function __construct($id, $email, $password_hash)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password_hash = $password_hash;
    }

    function user_in_role($role)
    {
        if ($this->roles == null) {
            return false;
        }

        foreach ($this->roles as $key => $e) {
            if ($e->name == $role) {
                return true;
            }
        }

        return false;
    }
}