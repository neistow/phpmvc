<?php


namespace app\models;


class Actor
{
    public $id;
    public $first_name;
    public $last_name;

    function __construct($id, $first_name, $last_name)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }
}