<?php


namespace app\models;


class User
{
    public $id;
    public $email;
    public $password_hash;

    function __construct($id, $email, $password_hash)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password_hash = $password_hash;
    }
}