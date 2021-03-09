<?php


namespace app\core;


class ControllerBase
{
    protected $request;
    protected $response;

    function __construct()
    {
        $this->request = Application::$GlobalThis->request;
        $this->response = Application::$GlobalThis->response;
    }

    protected function renderPage($pageName, $params = [])
    {
        $layout = $this->getLayout();
        $view = $this->getView($pageName, $params);
        return str_replace('{{content}}', $view, $layout);
    }

    public function badRequest($msg = "")
    {
        return $this->renderPage('400', ["msg" => $msg]);
    }

    public  function notFound($msg = "")
    {
        return $this->renderPage('404', ["msg" => $msg]);
    }

    private function getLayout()
    {
        $user = Application::$GlobalThis->user;

        ob_start();
        include_once __DIR__ . "/../views/layout.php";
        return ob_get_clean();
    }

    private function getView($viewName, $params = [])
    {
        $user = Application::$GlobalThis->user;

        foreach ($params as $key => $val) {
            $$key = $val;
        }

        ob_start();
        include_once __DIR__ . "/../views/$viewName.php";
        return ob_get_clean();
    }
}