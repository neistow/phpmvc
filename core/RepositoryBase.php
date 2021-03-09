<?php


namespace app\core;


abstract class RepositoryBase
{
    protected $db;

    function __construct($database)
    {
        $this->db = $database;
    }

    abstract function getAll();

    abstract function getById($id);

    abstract function update($entity);

    abstract function add($entity);

    abstract function delete($id);
}