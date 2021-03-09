<?php


namespace app\models;


class Film
{
    public $id;
    public $name;
    public $date_released;
    public $rating;

    function __construct($id, $name, $date_released, $rating)
    {
        $this->id = $id;
        $this->name = $name;
        $this->date_released = $date_released;
        $this->rating = $rating;
    }
}