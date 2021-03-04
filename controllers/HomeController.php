<?php

namespace app\controllers;

use app\core\ControllerBase;

class HomeController extends ControllerBase
{
    public function Index()
    {
        $data = [
            "person" => [
                "name" => "Foo",
                "surname" => "Bar",
                "age" => 20
            ]
        ];
        return $this->renderPage('home', $data);
    }
}