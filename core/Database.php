<?php


namespace app\core;


class Database
{
    private $connection;

    function __construct($host, $db, $user, $pass)
    {
        $this->connection = mysqli_connect($host, $user, $pass, $db);
    }

    public function queryMultiple($query)
    {
        $result = mysqli_query($this->connection, $query);
        if (!$result) {
            return null;
        }

        $data = mysqli_fetch_all($result);
        mysqli_free_result($result);

        return $data;
    }

    public function querySingle($query)
    {
        $result = mysqli_query($this->connection, $query);
        if (!$result) {
            return null;
        }

        $data = $result->fetch_row();
        mysqli_free_result($result);

        return $data;
    }

    public function query($query)
    {
        mysqli_query($this->connection, $query);
    }
}