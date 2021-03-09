<?php


namespace app\models;


class FilmActor
{
    public $film_id;
    public $actor_id;
    public $first_name;
    public $last_name;
    public $role_name;

    function __construct($film_id, $actor_id, $first_name, $last_name, $role_name)
    {
        $this->film_id = $film_id;
        $this->actor_id = $actor_id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->role_name = $role_name;
    }
}